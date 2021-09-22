<template>
  <v-container>
    <v-row class="ml-5">
      <v-col cols="8">
        <app-data-card :data="cart" />
      </v-col>
      <v-col
        class="posistion"
        cols="4"
      >
        <app-data-buy />
      </v-col>
      <v-col cols="12">
        <app-data-wistlist />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import card from './component_core/_card.vue'
  import buy from './component_core/_cardBuy.vue'
  import wistlist from './component_core/_cardWistlist.vue'
  export default {
    components: {
      'app-data-card': card,
      'app-data-buy': buy,
      'app-data-wistlist': wistlist,
    },
    data: () => ({}),
    computed: {
      cart () {
        return this.$store.state.cart.data
      },
    },
    mounted () {
      this.getDataCart()
    },
    methods: {
      getDataCart () {
        this.$store.dispatch('cart/getDataCart', {
          entities: 'user,class.studio, class.category, class.img',
          type: 'cart',
        })
      },
    },
  }
</script>

<style lang="sass">
.posistion
    position: fixed
    margin-left: 771px
</style>
