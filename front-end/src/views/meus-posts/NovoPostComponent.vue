<template>
  <div>
    <h3>Novo Post</h3>

    <div class="card">
      <div class="card-body">
        <form @submit.prevent="hundleSubmit">
          <AlertError v-if="error" :error="error" />
          <div class="mb-3">
            <label for="post" class="form-label">Digite aqui seu post: </label>
            <textarea
              class="form-control"
              v-model="post"
              name="post"
              rows="3"
              placeholder="Post deve conter no máximo 280 Caracteres"
            ></textarea>
          </div>
          <button class="btn btn-primary">Postar</button>
        </form>
      </div>
    </div>
  </div>


</template>

<script>
import axios from 'axios';

export default {
  name: "NovoPostComponent",
  data() {
    return {
      post: '',
      error: ''
    };
  },
  methods: {
    async hundleSubmit() {
      try {

        this.error = '';

        if(this.post === "") {
          this.error = 'O campo post deve ser preenchido'
          return;
        }

        await axios.post('posts', {
          post: this.post,
        }); 
        
        alert('Post cadastrado com sucesso');

        this.post = '';

      } catch (error) {
        console.error(error);
        this.error = 'Ocorreu um error';
      }
    }
  }
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
