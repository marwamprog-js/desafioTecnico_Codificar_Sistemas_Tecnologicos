<template>
  <div class="principal">
    <div class="menu">
      <NavbarComponent />
    </div>

    <div class="container mt-4">
      <div class="row">
        <div class="col-3">
          <div class="card">
            <div class="card-body">
              <h4>{{ userAuth.name }}</h4>
              <p>Quantidade de posts 4</p>
            </div>
          </div>
        </div>
        <div class="col-6">
            <div class="pages">
                <router-view></router-view>
            </div>
        </div>  
        <div class="col-3">
        </div>          
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import NavbarComponent from "./components/NavbarComponent.vue";

export default {
  name: "PrincipalComponent",
  components: { 
    NavbarComponent 
  },
  data() {
    return {
      userAuth: {}
    }
  },
  async created() {

    try {
      this.userAuth = {}
          
      const response = await axios.get('me');
      console.log('userAuth >>>> ', response);
      this.userAuth = response.data;
      this.$store.dispatch('user', this.userAuth);      
    } catch (error) {
      console.error(error);
    }

  }
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
