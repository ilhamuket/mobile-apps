<template>
  <v-app>
    <v-container
      id="user-profile"
      tag="section"
    >
      <v-row justify="center">
        <v-col
          cols="12"
          md="8"
        >
          <base-material-card>
            <template v-slot:heading>
              <div class=" font-weight-light">
                Edit Profile
              </div>

              <div class=" font-weight-light">
                Complete your profile
              </div>
            </template>

            <v-form>
              <v-container class="py-0">
                <v-row>
                  <v-col
                    cols="12"
                    md="6"
                  >
                    <v-text-field
                      v-model="users.firstName"
                      prepend-icon=" mdi-account-box-multiple"
                      class="purple-input"
                      label="First Name"
                    />
                  </v-col>

                  <v-col
                    cols="12"
                    md="6"
                  >
                    <v-text-field
                      v-model="users.lastName"
                      prepend-icon="mdi-account-box-multiple-outline"
                      class="purple-input"
                      label="Last Name"
                    />
                  </v-col>

                  <v-col
                    cols="12"
                    md="6"
                  >
                    <v-text-field
                      v-model="users.email"
                      prepend-icon="mdi-email-edit-outline"
                      label="Email Address"
                      class="purple-input"
                    />
                  </v-col>

                  <v-col
                    cols="12"
                    md="6"
                  >
                    <v-text-field
                      v-model="users.nickName"
                      prepend-icon="mdi-account-child "
                      label="User name"
                      class="purple-input"
                    />
                  </v-col>

                  <v-col
                    cols="12"
                    md="12"
                  >
                    <v-text-field
                      v-model="users.noHp"
                      prepend-icon="mdi-phone-hangup-outline"
                      label="Number Phone"
                      class="purple-input"
                    />
                  </v-col>

                  <v-col cols="12">
                    <v-text-field
                      v-model="users.homeAddress"
                      prepend-icon="mdi-map-marker-outline "
                      label="Adress"
                      class="purple-input"
                    />
                  </v-col>

                  <v-col cols="12">
                    <v-textarea
                      prepend-icon="mdi-information-variant "
                      class="purple-input"
                      label="About Me"
                      value="Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum fugit molestias vero illum labore a dignissimos veritatis, dolore aperiam expedita dolorum aut esse odit alias soluta necessitatibus ullam eaque fuga fugiat perspiciatis amet exercitationem sequi. Nisi rerum iusto corporis at amet, perspiciatis provident blanditiis molestiae. Possimus sunt quod sequi repellendus sed dolorem? Necessitatibus pariatur vitae dicta eos excepturi laborum nesciunt corporis quo atque omnis dolores, deleniti ipsa? Dolores sunt iste similique hic, repellendus quam? Aliquid culpa harum repudiandae eius amet illum, totam quod, delectus alias tempore voluptatibus quidem. Repellat cum optio magni eligendi. Obcaecati vel necessitatibus amet optio pariatur sed."
                    />
                  </v-col>

                  <v-col
                    cols="12"
                    class="text-right"
                  >
                    <v-btn
                      color="success"
                      class="mr-0"
                    >
                      Update Profile
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
          </base-material-card>
        </v-col>

        <v-col
          cols="12"
          md="4"
        >
          <base-material-card
            class="v-card-profile"
            avatar="https://demos.creative-tim.com/vue-material-dashboard/img/marc.aba54d65.jpg"
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
                Don't be scared of the truth because we need to restart the
                human foundation in truth And I love you like Kanye loves Kanye
                I love Rick Owens’ bed design but the back is...
              </p>

              <v-btn
                color="success"
                rounded
                class="mr-0"
              >
                Follow
              </v-btn>
            </v-card-text>
          </base-material-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {
    computed: {
      users () {
        return this.$store.state.user.me
      },
    },
    mounted () {
      this.me()
    },
    methods: {
      me () {
        this.$store.dispatch('user/me')
      },
    },
  }
</script>
