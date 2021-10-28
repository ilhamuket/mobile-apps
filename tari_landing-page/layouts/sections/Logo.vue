<template>
  <div class="logo">
    <NLink to="/">
      <v-img
        src="https://api.ensiklotari.com/images/category/2yWAsvcRa7gqGqBlvlVcgiyEfn1xuxvPMyRbWgZD.svg"
        alt="logo"
        width="160"
      />
    </NLink>
  </div>
</template>

<script>
export default {
  name: "Logo",

  data() {
    return {};
  },
};
</script>

<style lang="scss">
.logo a {
  display: flex;
}
</style>