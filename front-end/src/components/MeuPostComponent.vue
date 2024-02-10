<template>
  <div class="card mb-4">
    <div class="card-header">{{ user.name }} | {{ post.created_at }}</div>
    <div class="card-body">
      <p>
        {{ post.post }}
      </p>
    </div>
    <div class="card-body">
      <router-link class="btn btn-warning" :to="{ path: `/posts/${post.id}/atualizar`}">Atualizar</router-link>
      <button class="btn btn-danger ml-2" @click.prevent="hundleDeletar">Deletar</button>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import axios from 'axios';

export default {
  name: "MeuPostComponent",
  props: ["post", "user"],
  methods: {
    async hundleDeletar() {
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
            await axios.delete(`posts/${this.post.id}`, {
              headers: {
                Authorization: 'Bearer ' + localStorage.getItem("token")
              }
            });

            Swal.fire({
              title: "Deletado!",
              text: "Seu post foi deletado com sucesso.",
              icon: "success",
            });  
            
            document.getElementById(this.post.id).remove();          


          } catch (error) {
            
            if(error.response.status === 500) {
              this.$notify({
                type: "error",
                title: "error",
                text: "Erro ao deletar. Favor tente novamente! Caso volte a acontecer entrar em contato com suporte.",
              });
            } else {
              this.logout(); 
            }
          }
        }
      });
    },
    logout() {
      this.$swal("Algo de errado aconteceu. Tente logar novamente. Se o erro persistir favor entrar em contato com suporte.");
      localStorage.removeItem("token");
      this.$store.dispatch("user", {});
      this.$router.push({ name: "login" });
    }
  }
};
</script>

<style lang="scss" scoped></style>
