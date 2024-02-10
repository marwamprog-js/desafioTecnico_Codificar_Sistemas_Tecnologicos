<template>
  <div>
    <div class="card-header">{{ post.user }} | {{ post.created_at }}</div>
    <div class="card-body">
      <p>
        {{ post.post }}
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostComponent",
  props: ["post"],
};
</script>

<style lang="scss" scoped></style>
