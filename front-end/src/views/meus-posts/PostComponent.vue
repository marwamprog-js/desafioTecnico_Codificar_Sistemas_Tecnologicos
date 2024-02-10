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
           <NovoPostComponent />
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
import Swal from "sweetalert2";
import NavbarComponent from "../../components/NavbarComponent.vue";
import SidebarComponent from "../../components/SidebarComponent.vue";
import NovoPostComponent from "../../components/NovoPostComponent.vue";

export default {
  name: "PostsComponent",
  components: {
    NavbarComponent,
    SidebarComponent,
    NovoPostComponent,
  },
  data() {
    return {
      posts: {},
    };
  },
  computed: {
    ...mapGetters(["user", "postUpdate"]),
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
        .get(`posts/${idUserAuth}/user`)
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
    async hundleDeletar(post) {
      Swal.fire({
        title: "Tem certeza que deseja deletar o Post?",
        text: "Você não poderá reverter isso!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim",
        cancelButtonText: "Cancelar",
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            await axios.delete(`posts/${post.id}`);

            Swal.fire({
              title: "Deletado!",
              text: "Seu post foi deletado com sucesso.",
              icon: "success",
            });

            this.getUsers();
          } catch (error) {
            console.log(error);
            Swal.fire({
              title: "Error!",
              text: "Erro ao deletar. Favor tente novamente! Caso volte a acontecer entrar em contato com suporte.",
              icon: "error",
            });
          }
        }
      });
    },
  },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
