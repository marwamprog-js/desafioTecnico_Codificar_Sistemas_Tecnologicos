<template>
  <div class="principal">
    <div class="menu">
      <NavbarComponent />
    </div>

    <div class="container mt-4">
      <div class="row">
        <div class="col-2">
          <div class="card">
            <div class="card-body">
              <h4>Nome do usuário</h4>
              <p>Quantidade de posts 4</p>
            </div>
          </div>
        </div>
        <div class="col-10">
            <div class="pages">
                <PostsComponent />
            </div>
        </div>          
      </div>
    </div>
  </div>
</template>

<script>
import NavbarComponent from "./components/NavbarComponent.vue";
import PostsComponent from "../posts/PostsComponent.vue";

export default {
  name: "PrincipalComponent",
  components: { NavbarComponent, PostsComponent },
};
</script>

<style lang="scss" src="./style.scss" scoped></style>
