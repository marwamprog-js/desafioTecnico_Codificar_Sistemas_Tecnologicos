<template>
  <div class="col-3">
    <div class="card">
      <div class="card-body">
        <h4>{{ user ? user.name : '' }}</h4>
        <p>Quantidade de posts 4</p>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'SidebarComponent',
    computed: {
    ...mapGetters(['user'])
    },
}
</script>

<style lang="scss" scoped></style>
