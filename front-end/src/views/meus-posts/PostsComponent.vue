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

            <div class="card mb-4">
              <div class="card-body">
                <router-link class="btn btn-success" :to="{ name: 'novo-post' }">Novo Post</router-link>
              </div>
            </div>

            <div v-for="post in posts" :key="post.id">
              <MeuPostComponent :post="post" :user="user" :id="post.id" />
            </div>
            <AlertErrorComponent v-if="posts.length === 0" :errors="['Você não tem post cadastrado. Para realizar uma nova postagem, clique em Novo post.']" />

          </div>
        </div>
        <div class="col-3"></div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters, mapState } from "vuex";

import NavbarComponent from "../../components/NavbarComponent.vue";
import SidebarComponent from "../../components/SidebarComponent.vue";
import MeuPostComponent from "../../components/MeuPostComponent.vue";
import AlertErrorComponent from "../../components/AlertErrorComponent.vue";

export default {
  name: "PostsComponent",
  components: {
    NavbarComponent,
    SidebarComponent,
    MeuPostComponent,
    AlertErrorComponent
  },
  data() {
    return {
      posts: {},
    };
  },
  computed: {
    ...mapGetters(["user", "qtd_posts"]),
    ...mapState(["user"]),
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
        //Caso Token tenha expirado Fazer LOGOUT
        this.logout();  
      }
    }
    this.getMeuPosts();
  },
  methods: {
    async getMeuPosts() {

      try {
        const idUserAuth = this.user.id;
  
        const response = await axios
          .get(`posts/${idUserAuth}/user`, {
            headers: {
              Authorization: "Bearer " + localStorage.getItem('token'),
            },
          })
        
          this.posts = response.data.posts; 
        
      } catch (error) {
        if(error.response.status === 500) {
          this.$swal("Algo de errado aconteceu. Tente logar novamente. Se o erro persistir favor entrar em contato com suporte.");
        } else {
          this.logout(); 
        }
      }
      
    },
    hundleNovo() {
      this.$store.dispatch("postUpdate", "");

      this.$router.push({ name: "novo-post" });
    },
    hundleAtualizar(post) {
      this.$store.dispatch("postUpdate", post);

      this.$router.push({ name: "novo-post" });
    },
    logout() {
      this.$swal("Algo de errado aconteceu. Tente logar novamente. Se o erro persistir favor entrar em contato com suporte.");
      localStorage.removeItem("token");
      this.$store.dispatch("user", {});
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
          this.$swal("Algo de errado aconteceu. Tente logar novamente. Se o erro persistir favor entrar em contato com suporte.");
        } else {
          this.logout(); 
        }
      }
    }    
  },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
