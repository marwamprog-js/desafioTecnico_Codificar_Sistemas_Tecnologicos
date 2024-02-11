<template>
  <div>
    <nav class="navbar navbar-light bg-light menu-superior">
      <div class="container">
        <a class="navbar-brand title" href="#">LibX</a>
        <div class="navbar-nav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'index' }"
                >Voltar</router-link
              >
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="row mt-5">
      <div class="col-6 offset-3">
        <div class="card">
          <p class="card-header">Olá novamente!</p>

          <div class="card-body">
            <form @submit.prevent="handleSubmit">
              <AlertError v-if="!isNotError" :errors="errors" />
              <div class="mb-3">
                <input
                  type="email"
                  class="form-control"
                  v-model="email"
                  name="email"
                  placeholder="E-mail"
                />
              </div>
              <div class="mb-3">
                <input
                  type="password"
                  class="form-control"
                  v-model="password"
                  name="password"
                  placeholder="Senha"
                />
              </div>
              <button class="btn btn-primary">Entrar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "LoginComponent",
  data() {
    return {
      email: "",
      password: "",
      isNotError: true,
      errors: [],
    };
  },
  methods: {
    async handleSubmit() {
      this.isNotError = true;
      this.errors = [];

      if (this.email === "") {
        this.errors.push("O campo email deve ser preenchido");
        this.isNotError = false;
      }

      if (this.password === "") {
        this.errors.push("O campo senha deve ser preenchido");
        this.isNotError = false;
      }

      if (this.password.length < 8) {
        this.errors.push("O campo senha deve ter no mínimo 8 caracteres");
        this.isNotError = false;
      }

      if (this.isNotError) {

        await axios
          .post("login", {
            email: this.email,
            password: this.password,
          })
          .then((response) => {

            localStorage.setItem("token", response.data.token);

            // this.$store.dispatch("token", response.data.token);
            this.$store.dispatch("user", response.data);

            this.$router.push({ name: "principal" });
          })
          .catch((error) => {
            
            if(error.response.status === 500) {
              this.$swal("Algo de errado aconteceu. Tente logar novamente. Se o erro persistir favor entrar em contato com suporte.");
            } else {
              this.isNotError = false;
              this.errors = [];
              this.errors.push(error.response.data.error);
            }

          });
      }
    },
    
  },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
