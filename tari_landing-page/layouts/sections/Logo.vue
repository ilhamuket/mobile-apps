<template>
  <div class="logo">
    <NLink to="/">
      <v-img
        :src="require('@/assets/images/breadcumb/ensiklotariLogo.svg')"
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