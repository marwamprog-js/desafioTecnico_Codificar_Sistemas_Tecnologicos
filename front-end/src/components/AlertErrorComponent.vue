<template>
  <div class="alert alert-danger">
    {{ error }}
  </div>
</template>

<script>
export default {
  name: "AlertErrorComponent",
  props: ['error']
};
</script>

<style scoped></style>
