<template>
  <div class="col-3">
    <div class="card">
      <div class="card-body">
        <h4>{{ user ? user.name : '' }}</h4>
        <p>Quantidade de posts {{ qtd_posts ? qtd_posts : 'Err' }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'SidebarComponent',
    computed: {
    ...mapGetters(['user', 'qtd_posts'])
    },
}
</script>

<style lang="scss" scoped></style>
