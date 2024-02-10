<template>
  <div class="alert alert-danger">
    <div v-for="error in errors" :key="error">
      <span>{{ error }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "AlertErrorComponent",
  props: ['errors']
};
</script>

<style scoped></style>
