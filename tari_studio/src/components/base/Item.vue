<template>
  <v-list-item
    :href="href"
    :rel="href && href !== '#' ? 'noopener' : undefined"
    :target="href && href !== '#' ? '_blank' : undefined"
    :to="item.to"
    :active-class="`${!isDark ? 'white' : 'white'}--text`"
  >
    <!-- :active-class="
      drawer ? 'drawer--off' : `${!isDark ? 'green' : 'red'}--text`
    " -->
    <v-list-item-icon
      v-if="text"
      class="v-list-item__icon--text"
      v-text="computedText"
    />

    <v-list-item-icon v-else-if="item.icon">
      <div>
        <v-icon v-text="item.icon" />
        <p
          v-if="!drawer"
          class="font-weight-light fs-12 font-spartan"
        >
          {{ item.title }}
        </p>
      </div>
    </v-list-item-icon>

    <v-list-item-content v-if="item.title || item.subtitle">
      <v-list-item-title
        class="font-weight-light fs-12 font-spartan"
        v-text="item.title"
      />

      <v-list-item-subtitle v-text="item.subtitle" />
    </v-list-item-content>
  </v-list-item>
</template>

<script>
  import Themeable from 'vuetify/lib/mixins/themeable'

  export default {
    name: 'Item',

    mixins: [Themeable],

    props: {
      item: {
        type: Object,
        default: () => ({
          href: undefined,
          icon: undefined,
          subtitle: undefined,
          title: undefined,
          to: undefined,
        }),
      },
      text: {
        type: Boolean,
        default: false,
      },
    // drawer: {
    //   type: Boolean,
    //   default: false,
    // },
    },

    computed: {
      drawer () {
        return this.$store.state.drawer
      },
      computedText () {
        if (!this.item || !this.item.title) return ''

        let text = ''

        this.item.title.split(' ').forEach(val => {
          text += val.substring(0, 1)
        })

        return text
      },
      href () {
        return this.item.href || (!this.item.to ? '#' : undefined)
      },
    },
  }
</script>
<style lang="sass" scoped>
.fs-12
  font-size: 12px !important
</style>
