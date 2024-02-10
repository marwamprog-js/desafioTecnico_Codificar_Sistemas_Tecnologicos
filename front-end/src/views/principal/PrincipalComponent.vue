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
            <div class="card mb-4" v-for="post in posts" :key="post.id">
              <PostComponent :post="post" />
            </div>
            <AlertErrorComponent
              v-if="!posts"
              :errors="['O Sistema ainda não possuí posts cadastrados.']"
            />
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
import PostComponent from "../../components/PostComponent.vue";
import AlertErrorComponent from "../../components/AlertErrorComponent.vue";

export default {
  name: "PrincipalComponent",
  components: {
    NavbarComponent,
    SidebarComponent,
    PostComponent,
    AlertErrorComponent,
  },
  data() {
    return {
      posts: {},
    };
  },
  computed: {
    ...mapGetters(["user"]),
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
        //Caso Token tenha expirado Fazer LOGOUT
        this.logout();
      }
    }
  },
  mounted() {
    this.getPosts();
  },
  methods: {
    async getPosts() {
      try {
        const response = await axios.get("http://localhost:8000/api/v1/posts", {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        });

        this.posts = response.data.posts;
      } catch (error) {
        if(error.response.status === 500) {
          this.$swal("Algo de errado aconteceu. Tente logar novamente. Se o erro persistir favor entrar em contato com suporte.");
        } else {
          this.logout(); 
        }
      }
    },
    logout() {
      this.$swal("Algo de errado aconteceu. Tente logar novamente. Se o erro persistir favor entrar em contato com suporte.");
      localStorage.removeItem("token");
      this.$store.dispatch("user", {});
      this.$router.push({ name: "login" });
    }
  },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
