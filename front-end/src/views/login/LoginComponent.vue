<template>
  <div>
    <nav class="navbar navbar-light bg-light menu-superior">
      <div class="container">
        <a class="navbar-brand title" href="#">LibX</a>
        <div class="navbar-nav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'index' }">Voltar</router-link>
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
                <AlertError v-if="error" :error="error" />
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
      error: ""
    };
  },
  methods: {
    async handleSubmit() {
        try {
            let response = await axios.post("login", {
              email: this.email,
              password: this.password,
            });
      
            localStorage.setItem("token", response.data.token);

            console.log('Token Login ::: ', localStorage.getItem('token'))
            
            response = await axios.get("me", {
              headers: {
                Authorization: "Bearer " + response.data.token
              }
            });

            this.$store.dispatch("user", response.data);
      
            this.$router.push({ name: "principal" });
            
        } catch (e) {
            console.log(e)
            this.error = 'Usuário / senha inválidos';
        }
    },
  },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
