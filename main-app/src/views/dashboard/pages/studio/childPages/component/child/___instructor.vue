<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <v-card-title class="font-spartan text-h3 font-italic">
          Instructor
        </v-card-title>
      </v-col>
    </v-row>

    <v-row class="mt-12">
      <v-col
        v-for="item in data"
        :key="item.id"
        cols="12"
        :md="data.length % 2 === 0 ? '6' : '4'"
        sm="12"
      >
        <v-card
          width="600"
          height="380"
          class="d-flex grow flex-wrap mt-4"
        >
          <v-card-text>
            <v-avatar
              size="55"
              class="d-flex justify-center mx-auto elevation-6"
              color="primary"
            >
              <!-- <v-img src="https://cdn.vuetifyjs.com/images/john.jpg" /> -->
              <span>{{ item.name.charAt(0) }}</span>
            </v-avatar>

            <v-list-item two-line>
              <v-list-item-content class="">
                <v-list-item-title>
                  <span class="font-size-ather-roboto-mono">
                    {{ item.name }}
                  </span>
                </v-list-item-title>
                <v-list-item-subtitle>
                  <!-- <v-icon class="">
                      mdi-map-marker
                    </v-icon> -->

                  <span class="mr-2 font-size-ather-roboto-mono">
                    {{ item.profession }}
                  </span>
                </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
            <v-list-item two-line>
              <v-list-item-content class="font-size-ather-roboto-mono">
                <v-list-item-title>
                  <span class="font-size-ather-roboto-mono">
                    {{ item.email }}
                  </span>
                </v-list-item-title>
                <v-list-item-subtitle>
                  <span
                    class="font-size-ather-roboto-mono text-capitalize"
                  >{{ item.region }} - {{ item.contact }}</span>
                </v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>

            <v-list-item two-line>
              <v-list-item-content class="font-size-ather-roboto-mono">
                <v-list-item-title
                  class="font-size-ather-roboto-mono mb-1 border-bottom"
                >
                  #About
                </v-list-item-title>

                <v-tooltip
                  v-if="item.about.length > 150"
                  bottom
                  color="blue"
                >
                  <template #activator="{on, attrs}">
                    <span
                      v-bind="attrs"
                      v-on="on"
                    >
                      "{{ item.about.substr(0, 150) + ' ... ' }}"
                    </span>
                  </template>
                  <span>{{ item.about }}</span>
                </v-tooltip>
                <p v-else>
                  "{{ item.about }}"
                </p>
              </v-list-item-content>
            </v-list-item>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
    },
    computed: {
      roles () {
        // let rolesName = []
        if (this.data.role != null) {
          // rolesName = this.data.role
          this.data.role.foreach(x => x.name)
        }
        return this.data.role
      },
    },
    mounted () {
      console.log(this.data)
    },
  }
</script>

<style lang="sass">
.border-bottom
  border-bottom: 2x double red !important
</style>
