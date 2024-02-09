<template>    
    <div>
      <div class="mb-3">
        <router-link :to="{ name: 'novo-post' }" class="btn btn-sm btn-success">Novo Post</router-link>
      </div>
      <div class="card mb-4" v-for="post in posts" :key="post.id">
        <div class="card-header">{{ post.user.name }} | {{ post.created_at }}</div>
        <div class="card-body">
          <p>
            {{ post.post }}
          </p>
        </div>
        <div class="card-footer text-muted text-center">
          <a href="#" class="btn btn-sm btn-warning">Alterar</a>
          <a href="#" class="btn btn-sm btn-danger ml-2">Excluir</a>
        </div>
      </div>      

      <nav
        aria-label="Page navigation example"
        style="margin-top: 50px; margin-bottom: 80px"
      >
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">&laquo;</span>
            </a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">&raquo;</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
</template>

<script>
import axios from 'axios';
import { mapGetters } from 'vuex';

export default {
  name: "MeusPostsComponent",
  data() {
    return {
      posts: {}
    }
  },
  mounted() {
    this.getUsers()
  },
  methods: {
    async getUsers() {
      
      const idUserAuth = this.user.id

      const response = await axios.get(`posts/${idUserAuth}/user`)
      .then((res) => {
        console.log(res.data)
        this.posts = res.data.posts;
      })
      .catch((error) => {
        console.error(error)
      });

      console.log(response)

      // if(response.status == 200) {
      //   // console.log(response.data);
      //   this.posts = response.data;
      // } else {
      //   console.error("ocorreu um erro na api");
      // }
    }
  },
  computed: {
    ...mapGetters(['user'])
  }
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
