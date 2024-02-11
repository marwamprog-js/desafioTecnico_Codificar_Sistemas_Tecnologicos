<template>
  <div class="principal">
    <div class="menu">
      <NavbarComponent />
    </div>

    <div class="container mt-4">
      <div class="row">
        <SidebarComponent />
        <div class="col-6">
          <div class="pages">
            <h3>Novo Post</h3>

            <div class="card">
              <div class="card-body">
                <form @submit.prevent="hundleSubmit">
                  <AlertError v-if="!isNotError" :errors="errors" />
                  <div class="mb-3">
                    <label for="post" class="form-label"
                      >Digite aqui seu post:
                    </label>
                    <textarea
                      class="form-control"
                      v-model="post"
                      maxlength="280"
                      name="post"
                      rows="3"
                      placeholder="Post deve conter no máximo 280 Caracteres"
                    ></textarea>
                  </div>
                  <button class="btn btn-primary">Postar</button>
                  <router-link
                    class="btn btn-danger ml-2"
                    :to="{ name: 'posts' }"
                    >Voltar</router-link
                  >
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="col-3"></div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import NavbarComponent from "../../components/NavbarComponent.vue";
import SidebarComponent from "../../components/SidebarComponent.vue";

export default {
  name: "NovoPostComponent",
  components: {
    NavbarComponent,
    SidebarComponent
  },  
  computed: {
    ...mapGetters(["user", "qtd_posts"]),
  },
  data() {
    return {
      post: "",
      isNotError: true,
      errors: []
    };
  },
  async created() {
    if (this.user) {
      try {
        let response = await axios.get("me", {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        });

        this.$store.dispatch("user", response.data);
        this.getQtdPost(response.data.id);

      } catch (error) {
        this.logout();
      }
    }
  },
  methods: {
    async hundleSubmit() {
      try {
        this.isNotError = true;

        if (this.post === "") {
          this.errors.push("O campo post deve ser preenchido");
          this.isNotError = false;
        }

        if (this.post.length > 280) {
          this.errors.push(`O campo post deve no máximo 280 caracteres. Foram digitados ${this.post.length}`);
          this.isNotError = false;
        }

        if(this.isNotError) {
          await axios.post("posts", { post: this.post }, {
            headers: {
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
          });
  
          this.getQtdPost(this.user.id);

          this.$swal("Mensagem postada com sucesso");
  
          this.post = "";
        }

      } catch (error) {
        if(error.response.status === 500) {
          this.$notify({
            type: "error",
            title: "Info",
            text: "Algo de errado aconteceu. Tente novamente. Se o erro persistir favor entrar em contato com suporte.",
          });
        } else {
          this.logout(); 
        }
        
      }
    },
    logout() {
      this.$swal("Algo aconteceu. Você foi delogado. Caso queira continuar, favor efetuar login.");
      localStorage.removeItem("token");
      this.$store.dispatch("user", {});
      localStorage.setItem("isLogged", false);
      this.$router.push({ name: "login" });
    },
    async getQtdPost(id) {
      try {
        const response = await axios.get(`http://localhost:8000/api/v1/posts/${id}/qtd-posts`, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        });

        this.$store.dispatch("qtd_posts", response.data.qtd_posts);
        

      } catch (error) {
        if(error.response.status === 500) {
          this.$swal("Algo aconteceu. Você foi deslogado. Caso queira continuar, favor efetuar login.");
        } else {
          this.logout(); 
        }
      }
    } 
  },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
