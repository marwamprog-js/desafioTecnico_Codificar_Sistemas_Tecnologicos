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
            <h3 v-if="this.post">Alterar Post</h3>

            <div class="card">
              <div class="card-body">
                <form @submit.prevent="hundleSubmit">
                  <AlertError v-if="error" :error="error" />
                  <div class="mb-3">
                    <label for="post" class="form-label"
                      >Digite aqui seu post:
                    </label>
                    <textarea
                      class="form-control"
                      v-model="post"
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
  data() {
    return {
      post: "",
      error: "",
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
      } catch (error) {
        console.error(error);
      }
    }

    try {
      const id = this.$route.params.id;

      const response = await axios.get(`posts/${id}`, {
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      });

      this.post = response.data.post.post;
    } catch (error) {
      console.error(error);
    }
  },
  methods: {
    async hundleSubmit() {
      try {
        this.error = "";

        if (this.post === "") {
          this.error = "O campo post deve ser preenchido";
          return;
        }

        await axios.put(`posts/${this.$route.params.id}`, { post: this.post }, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        });

        this.$swal("Mensagem postada com sucesso");
        

      } catch (error) {
        this.$notify({
          type: "error",
          title: "Info",
          text: "Ocorreu um error",
        });
      }
    },
  },
  computed: {
    ...mapGetters(["user", "postUpdate"]),
  },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
