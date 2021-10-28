<template>
  <div class="logo">
    <NLink to="/">
      <v-img
        src="https://www.ensiklotari.com/img/new/ensiklotariLogo.svg"
        alt="logo"
        width="200"
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