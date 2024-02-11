<template>
  <div class="principal">
    <div class="menu">
      <NavbarComponent />
    </div>

    <div class="container mt-4">
      <div class="row">
        <SidebarComponent :qtd_posts="qtd_posts" />
        <div class="col-6">
          <div class="pages">
            <div class="card mb-4 card-page">
              <h2 class="text-center mb-5">Email: {{ user.email }}</h2>

              <form @submit.prevent="handleSubmit">
                <h4>Alterar Nome</h4>

                <AlertErrorComponent
                  v-if="!this.isNotError"
                  :errors="this.errors"
                />

                <div class="mb-3">
                  <label for="name" class="form-label">Nome: </label>
                  <input
                    type="text"
                    class="form-control"
                    v-model="name"
                    placeholder=""
                  />
                </div>

                <button class="btn btn-primary">Alterar Nome</button>
              </form>

              <form class="mt-5" @submit.prevent="handleSubmitAlterarSenha">
                <h4>Alterar Senha</h4>

                <AlertErrorComponent
                  v-if="!this.isNotErrorAlterarSenha"
                  :errors="this.errorsAlterarSenha"
                />

                <div class="mb-3">
                  <label for="name" class="form-label">Senha Anterior: </label>
                  <input
                    type="password"
                    class="form-control"
                    name="senha_anterior"
                    v-model="senha_anterior"
                    placeholder=""
                  />
                </div>

                <div class="mb-3">
                  <label for="name" class="form-label">Nova Senha: </label>
                  <input
                    type="password"
                    class="form-control"
                    name="nova_senha"
                    v-model="nova_senha"
                    placeholder=""
                  />
                </div>

                <button class="btn btn-primary">Alterar Senha</button>
              </form>
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
import AlertErrorComponent from "../../components/AlertErrorComponent.vue";

export default {
  name: "PrincipalComponent",
  components: {
    NavbarComponent,
    SidebarComponent,
    AlertErrorComponent,
  },
  data() {
    return {
      name: "",
      senha_anterior: "",
      nova_senha: "",
      isNotError: true,
      errors: [],
      isNotErrorAlterarSenha: true,
      errorsAlterarSenha: [],
    };
  },
  computed: {
    ...mapGetters(["user", "qtd_posts"]),
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
        this.name = response.data.name;
      } catch (error) {
        //Caso Token tenha expirado Fazer LOGOUT
        this.logout();
      }
    }
    this.getQtdPost(this.user.id);
  },
  methods: {
    async handleSubmit() {
      try {
        this.isNotError = true;
        this.errors = [];

        if (this.name === "") {
          this.errors.push("O campo nome deve ser preenchido");
          this.isNotError = false;
        }

        if (this.name.length < 5) {
          this.errors.push("O campo nome deve ter no mínimo 5 caracteres");
          this.isNotError = false;
        }

        if (this.name.length > 15) {
          this.errors.push("O campo nome deve ter no máximo 15 caracteres");
          this.isNotError = false;
        }

        if (this.isNotError) {
          await axios.patch(
            "users/altera-nome",
            {
              name: this.name,
            },
            {
              headers: {
                Authorization: "Bearer " + localStorage.getItem("token"),
              },
            }
          );

          let usuario = this.user;
          usuario.name = this.name;

          this.$store.dispatch("user", usuario);

          this.$swal("Nome alterado com sucesso");
        }
      } catch (error) {
        this.isNotError = false;
        this.errors.push("Ocorreu um error");
      }
    },
    async handleSubmitAlterarSenha() {
      try {
        this.isNotErrorAlterarSenha = true;
        this.errorsAlterarSenha = [];

        if (this.senha_anterior === "") {
          this.errorsAlterarSenha.push("O campo senha anterior deve ser preenchido");
          this.isNotErrorAlterarSenha = false;
        }

        if (this.senha_anterior.length < 8) {
          this.errorsAlterarSenha.push("O campo senha anterior deve ter no mínimo 8 caracteres");
          this.isNotErrorAlterarSenha = false;
        }

        if (this.nova_senha === "") {
          this.errorsAlterarSenha.push("O campo nova senha deve ser preenchido");
          this.isNotErrorAlterarSenha = false;
        }

        if (this.nova_senha.length < 8) {
          this.errorsAlterarSenha.push("O campo nova senha deve ter no mínimo 8 caracteres");
          this.isNotErrorAlterarSenha = false;
        }

        console.log(this.senha_anterior);
        console.log(this.nova_senha);

        if (this.isNotErrorAlterarSenha) {
          await axios.patch(
            "users/altera-senha",
            {
              senha_anterior: this.senha_anterior,
              nova_senha: this.nova_senha,
            },
            {
              headers: {
                Authorization: "Bearer " + localStorage.getItem("token"),
              },
            }
          );

          let usuario = this.user;
          usuario.name = this.name;

          this.$store.dispatch("user", usuario);

          this.$swal("Senha alterada com sucesso");
        }
      } catch (error) {
        this.isNotErrorAlterarSenha = false;

        if(error.response.status === 403) {
          this.errorsAlterarSenha.push(error.response.data.error);
        } else {
          this.errorsAlterarSenha.push('Algo deu errado!');
        }
      }
    },
    logout() {
      this.$swal(
        "Algo aconteceu. Você foi deslogado. Caso queira continuar, favor efetuar login."
      );
      localStorage.removeItem("token");
      this.$store.dispatch("user", {});
      localStorage.setItem("isLogged", false);
      this.$router.push({ name: "login" });
    },
    async getQtdPost(id) {
      try {
        const response = await axios.get(
          `http://localhost:8000/api/v1/posts/${id}/qtd-posts`,
          {
            headers: {
              Authorization: "Bearer " + localStorage.getItem("token"),
            },
          }
        );

        this.$store.dispatch("qtd_posts", response.data.qtd_posts);
      } catch (error) {
        if (error.response.status === 500) {
          this.$swal(
            "Algo de errado aconteceu. Tente logar novamente. Se o erro persistir favor entrar em contato com suporte."
          );
        } else {
          this.logout();
        }
      }
    },
  },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
