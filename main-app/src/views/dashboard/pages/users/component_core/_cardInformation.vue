<template>
  <v-card class="rounded stadarlize">
    <div class="d-flex flex-row">
      <div class="d-flex-column">
        <v-card-title>
          <span class="text-h4 font-size-ather-roboto-mono">Following</span>
        </v-card-title>
      </div>
      <div class="d-flex flex-column mt-2 i-left">
        <v-icon color="blue">
          mdi-arrow-right
        </v-icon>
      </div>
    </div>
    <div class="d-flex flex-row mt-2">
      <div class="d-flex-column">
        <v-card-title>
          <span class="text-h5 font-size-ather-roboto-mono">Studio</span>
        </v-card-title>
      </div>
    </div>

    <v-list
      v-if="me.following_studio"
      max-height="386"
      class="overflow-y-auto"
    >
      <v-list-item
        v-for="list in me.following_studio"
        :key="list.id"
      >
        <v-list-item-avatar>
          <v-img src="https://cdn.vuetifyjs.com/images/lists/4.jpg" />
        </v-list-item-avatar>
        <v-list-item-content>
          <v-list-item-title
            class="font-size-ather-roboto-mono"
            style="cursor:pointer"
            @click="pushToStudio(list.slug)"
          >
            <v-tooltip
              color="primary"
              bottom
            >
              <template #activator="{on,attrs}">
                <span
                  v-bind="attrs"
                  v-on="on"
                >
                  {{ list.name }}
                </span>
              </template>
              <span> {{ list.name }}</span>
            </v-tooltip>
          </v-list-item-title>
          <v-list-item-subtitle v-if="list.followers && list.likes">
            <v-icon color="blue">
              mdi-account-check
            </v-icon>
            {{ list.followers.length }}
            <v-icon color="red">
              mdi-heart
            </v-icon>
            {{ list.likes.length }}
          </v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-content>
          <v-btn
            color="primary"
            outlined
            @click="pushToStudio(list.slug)"
          >
            Explore
          </v-btn>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
</template>

<script>
  export default {
    props: {
      me: {
        type: Object,
        default: null,
      },
    },
    methods: {
      pushToStudio (slug) {
        this.$router.push(`/${slug}/home`)
      },
    },
  }
</script>

<style lang="sass" scoped>
.i-left
    margin-left: 205px !important
.stadarlize
  margin-top: -5px
.rounded
  border-radius: 20px !important
</style>
