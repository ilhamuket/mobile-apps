<template>
  <v-card class="rounded stadarlize">
    <div class="d-flex flex-row">
      <div class="d-flex-column">
        <v-card-title>
          <span
            class="text-h4 font-size-ather-roboto-mono"
          >Profile information</span>
        </v-card-title>
      </div>
      <div class="d-flex flex-column mt-2 i-left">
        <v-tooltip
          bottom
          color="blue"
        >
          <template #activator="{on, attrs}">
            <v-icon
              v-bind="attrs"
              color="blue"
              style="cursor:pointer"
              v-on="on"
              @click="popUpEdit(me)"
            >
              mdi-pencil
            </v-icon>
          </template>
          <span>Edit Profile</span>
        </v-tooltip>
      </div>
    </div>
    <div class="d-flex flex-row">
      <div class="d-flex flex-column">
        <v-card-text>
          <p class="font-spartan-small">
            "{{ me.about !== null ? me.about : dummy }}"
          </p>
        </v-card-text>
      </div>
    </div>

    <v-divider />

    <div class="d-flex flex-row">
      <div class="d-flex flex-column">
        <v-card-text>
          <div class="d-flex flex-row">
            <div class="d-flex flex-column">
              <span class="font-spartan-small">
                <span> {{ me.nickName }}</span></span>
            </div>
          </div>
          <div class="d-flex flex-row mt-2">
            <div class="d-flex flex-column">
              <span
                class="font-spartan-small"
              >Name :
                <span class="">
                  {{ me.firstName + ' ' + me.lastName }}</span></span>
            </div>
          </div>
          <div class="d-flex flex-row mt-2">
            <div class="d-flex flex-column">
              <span
                class="font-spartan-small"
              >Phone Number :
                <span> {{ me.noHp ? me.noHp : '-' }}</span></span>
            </div>
          </div>
          <div class="d-flex flex-row mt-2">
            <div class="d-flex flex-column">
              <span
                class="font-spartan-small"
              >Email :

                <span> {{ me.email }}</span>
              </span>
            </div>
          </div>
          <div class="d-flex flex-row mt-2">
            <div class="d-flex flex-column">
              <span
                class="font-spartan-small"
              >Location :
                <span>
                  {{
                    me.homeAddress !== null ? me.homeAddress : 'Bandung'
                  }}</span></span>
            </div>
          </div>
          <div class="d-flex flex-row mt-2">
            <div class="d-flex flex-column">
              <span
                class="font-spartan-small text-center m-114 mt-4"
              >Social :
                <div class="">
                  <v-tooltip
                    color="primary"
                    bottom
                  >
                    <template #activator="{on, attrs}">
                      <a
                        v-bind="attrs"
                        :href="me.url_tw"
                        target="__blank"
                        v-on="on"
                      >
                        <v-icon
                          :href="me.url_tw"
                          color="blue"
                        >mdi-twitter</v-icon>
                      </a>
                    </template>
                    <span>{{ me.username_tw }}</span>
                  </v-tooltip>
                  <v-tooltip
                    color="primary"
                    bottom
                  >
                    <template #activator="{on, attrs}">
                      <a
                        v-bind="attrs"
                        :href="me.url_ig"
                        target="__blank"
                        v-on="on"
                      >
                        <v-icon
                          class="ml-1"
                          color="#E1306C"
                        >
                          mdi-instagram</v-icon>
                      </a>
                    </template>
                    <span>{{ me.username_ig }}</span>
                  </v-tooltip>
                  <v-tooltip
                    bottom
                    color="primary"
                  >
                    <template #activator="{on, attrs}">
                      <a
                        v-bind="attrs"
                        :href="me.url_fb"
                        target="__blank"
                        v-on="on"
                      >
                        <v-icon
                          class="ml-1"
                          color="blue"
                        > mdi-facebook</v-icon>
                      </a>
                    </template>
                    <span>{{ me.username_fb }}</span>
                  </v-tooltip>
                </div>
              </span>
            </div>
          </div>
        </v-card-text>
      </div>
    </div>
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
    data: () => ({
      dummy: `Lorem ipsum dolor, sit amet consectetur adipisicing elit. Corporis
            dolorum, corrupti molestias distinctio facere ipsa dolores
            dignissimos neque culpa perferendis explicabo temporibus a officia
            tempora totam consequatur, assumenda aperiam! Magni et officia nemo.
            Cum voluptas deleniti quae fugit accusamus aliquid.`,
    }),
    methods: {
      popUpEdit (item) {
        this.$emit('popUpDialog', { item: item })
      },
    },
  }
</script>

<style lang="sass" scoped>
.i-left
    margin-left: 180px !important
.rounded
  border-radius: 20px !important
.stadarlize
  margin-top: -5px
.m-100
  margin-left: 204px
.m-114
  margin-left: 114px
a
  text-decoration: none
</style>
