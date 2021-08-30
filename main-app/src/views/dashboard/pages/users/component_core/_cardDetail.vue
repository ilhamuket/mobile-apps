<template>
  <v-card
    width="97%"
    class="rounded-xl"
  >
    <v-container>
      <v-row>
        <v-col cols="6">
          <v-row>
            <v-col cols="3">
              <v-img
                class="rounded-xl"
                width="60"
                src="https://demos.creative-tim.com/muse-vue-ant-design-dashboard/images/face-1.jpg"
              />
            </v-col>
            <v-col cols="9">
              <div class="d-flex flex-row  mt-2">
                <div class="d-flex flex-column">
                  <span
                    class="text-h4 font-size-ather-roboto-mono font-weight-bold"
                  >
                    {{ fullname }}
                  </span>
                </div>
              </div>
              <div class="d-flex flex-row">
                <div class="d-flex flex-column">
                  <span class="text-h4 font-size-ather-roboto-mono s-16">
                    {{ me.email }} -
                  </span>
                </div>

                <div class="d-flex flex-column ml-2">
                  <span class="text-h4 font-size-ather-roboto-mono s-16">
                    {{ me.noHp }}
                  </span>
                </div>
              </div>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="6">
          <v-row>
            <v-col>
              <div class="d-flex flex-row mt-5 ml-6">
                <div class="d-flex flex-column">
                  <v-btn
                    outlined
                    color="primary"
                    width="200"
                    small
                  >
                    Info
                  </v-btn>
                </div>
                <div class="d-flex flex-column ml-2">
                  <v-btn
                    outlined
                    color="primary"
                    width="200"
                    small
                  >
                    Info
                  </v-btn>
                </div>
              </div>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
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
    computed: {
      fullname () {
        return this.me.firstName + ' ' + this.me.lastName
      },
    },
  }
</script>

<style lang="sass" scoped>
.v-card
    border-radius: 20px !important
    margin-top: -85px !important
    margin-bottom: 15px !important
.v-application .ml-12
    margin-left: 73px !important
.col-3
    -webkit-box-flex: 0
    -ms-flex: 0 0 25%
    flex: 0 0 25%
    max-width: 16%
.w-chip
    width: 200px
.s-16
    font-size: 11px !important
</style>
