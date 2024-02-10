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

export default {
  name: "PrincipalComponent",
  components: {
    NavbarComponent,
    SidebarComponent,
    PostComponent,
  },
  data() {
    return {
      posts: {},
    };
  },
  async created() {
    console.log('Usuario --- ',this.user);
    if (this.user) {
      try {
        let response = await axios.get("me", {
          headers: {
            Authorization: "Bearer " + localStorage.getItem('token'),
          },
        });

        this.$store.dispatch("user", response.data);
      } catch (error) {
        console.error(error);
      }
    }

    this.getPosts();
  },
  computed: {
    ...mapGetters(["user"]),
  },
  methods: {
    async getPosts() {
      
      await axios
        .get("http://localhost:8000/api/v1/posts", {
          headers: {
            Authorization: "Bearer " + localStorage.getItem("token"),
          },
        })
        .then((res) => {
          this.posts = res.data.posts;
        })
        .catch((error) => {
          console.error(error);
        });
    },
  },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
