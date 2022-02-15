<template>
  <v-app>
    <v-container>
      <v-row>
        <v-col
          cols="12"
          md="4"
        >
          <base-material-card
            class="v-card-profile"
            avatar="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg"
            @push="$router.push('/user/settings')"
            @input="dialogOpen"
          >
            <v-card-text class="text-center">
              <h6 class=" mb-1 grey--text">
                My Account
              </h6>

              <h4
                :class="
                  $vuetify.theme.dark
                    ? 'font-weight-light mb-3 white--text'
                    : 'font-weight-light mb-3 black--text'
                "
                class="text-capitalize"
              >
                {{ users.firstName + ' ' + users.lastName }}
              </h4>

              <p class="font-weight-light grey--text">
                {{ users.about }}
              </p>
            </v-card-text>
          </base-material-card>
        </v-col>
        <v-col
          cols="12"
          md="8"
        >
          <v-card>
            <v-card-title class="d-flex justify-center mb-2">
              <h2>
                My Account
              </h2>
            </v-card-title>
            <v-card-text>
              <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>
                    Name:
                    <span class="float-right text-capitalize">
                      {{ users.firstName + ' ' + users.lastName }}
                    </span>
                  </v-list-item-title>
                  <v-list-item-subtitle>
                    Username:
                    <span class="float-right">
                      {{ users.nickName }}
                    </span>
                  </v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>
                    Email:
                    <span class="float-right">
                      {{ users.email }}
                    </span>
                  </v-list-item-title>
                  <v-list-item-subtitle>
                    Role :
                    <div
                      v-if="users.role"
                      class="float-right"
                    >
                      <span
                        v-for="n in users.role"
                        :key="n.id"
                        class="text-capitalize"
                      >
                        {{ n.name }}</span>
                    </div>
                  </v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
              <v-list-item three-line>
                <v-list-item-content>
                  <v-list-item-title>
                    <v-list-item-title>
                      Address:
                      <span class="float-right text-capitalize">
                        {{ users.homeAddress }}
                      </span>
                    </v-list-item-title>
                    <v-list-item-subtitle>
                      Date Of Birth:
                      <span class="float-right">
                        {{ users.dateOfBirth | moment('MMMM Do YYYY') }}
                      </span>
                    </v-list-item-subtitle>
                    <v-list-item-subtitle>
                      Phone Number:
                      <span class="float-right">
                        {{ users.noHp }}
                      </span>
                    </v-list-item-subtitle>
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>

              <v-list-item class="text-center">
                <v-list-item-content>
                  <h2>
                    Studio
                  </h2>
                </v-list-item-content>
              </v-list-item>
              <v-list-item two-line>
                <v-list-item-content>
                  <v-list-item-title>
                    Name :
                    <span
                      v-if="users.studio"
                      class="float-right"
                    >
                      {{ users.studio.name }}
                    </span>
                  </v-list-item-title>
                  <v-list-item-title>
                    Prefix :
                    <span
                      v-if="users.studio"
                      class="float-right"
                    >
                      {{ users.studio.prefix }}
                    </span>
                  </v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {
    data: () => ({}),
    computed: {
      users () {
        return this.$store.state.user.me
      },
    },
    mounted () {
      this.me()
      console.log(this.users)
    },
    methods: {
      me () {
        this.$store.dispatch('user/me')
      },
      dialogOpen () {
        console.log('text')
      },
    },
  }
</script>

<style></style>
