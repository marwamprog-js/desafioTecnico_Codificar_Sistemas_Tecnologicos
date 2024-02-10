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
import MeuPostComponent from "../../components/MeuPostComponent.vue";

export default {
  name: "PostsComponent",
  components: {
    NavbarComponent,
    SidebarComponent,
    MeuPostComponent,
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
        console.error(error);
      }
    }
    this.getUsers();
  },
  methods: {
    async getUsers() {
      const idUserAuth = this.user.id;

      const response = await axios
        .get(`posts/${idUserAuth}/user`, {
          headers: {
            Authorization: "Bearer " + localStorage.getItem('token'),
          },
        })
        .then((res) => {
          console.log(res.data);
          this.posts = res.data.posts;
        })
        .catch((error) => {
          console.error(error);
        });

      console.log(response);

      // if(response.status == 200) {
      //   // console.log(response.data);
      //   this.posts = response.data;
      // } else {
      //   console.error("ocorreu um erro na api");
      // }
    },
    hundleNovo() {
      this.$store.dispatch("postUpdate", "");

      this.$router.push({ name: "novo-post" });
    },
    hundleAtualizar(post) {
      this.$store.dispatch("postUpdate", post);

      this.$router.push({ name: "novo-post" });
    },
    
  },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
