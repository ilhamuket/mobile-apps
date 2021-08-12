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
                      label="Username"
                      class="purple-input"
                    />
                  </v-col>

                  <v-col
                    cols="12"
                    md="12"
                  >
                    <v-text-field
                      v-model="users.noHp"
                      type="number"
                      prepend-icon="mdi-phone-hangup-outline"
                      label="Number Phone"
                      class="purple-input"
                    />
                  </v-col>

                  <v-col
                    cols="12"
                    md="6"
                  >
                    <v-text-field
                      v-model="users.homeAddress"
                      prepend-icon="mdi-map-marker-outline "
                      label="Adress"
                      class="purple-input"
                    />
                  </v-col>

                  <v-col
                    cols="12"
                    sm="6"
                    md="6"
                  >
                    <v-menu
                      ref="menu"
                      v-model="menu"
                      :close-on-content-click="false"
                      :return-value.sync="users.dateOfBirth"
                      transition="scale-transition"
                      offset-y
                      min-width="auto"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="users.dateOfBirth"
                          label="Date Of Birth"
                          prepend-icon="mdi-calendar"
                          readonly
                          v-bind="attrs"
                          v-on="on"
                        />
                      </template>
                      <v-date-picker
                        v-model="date"
                        no-title
                        scrollable
                      >
                        <v-spacer />
                        <v-btn
                          text
                          color="primary"
                          @click="menu = false"
                        >
                          Cancel
                        </v-btn>
                        <v-btn
                          text
                          color="primary"
                          @click="$refs.menu.save(date)"
                        >
                          OK
                        </v-btn>
                      </v-date-picker>
                    </v-menu>
                  </v-col>

                  <v-col cols="12">
                    <v-textarea
                      v-model="users.about"
                      prepend-icon="mdi-information-variant "
                      class="purple-input"
                      label="About Me"
                    />
                  </v-col>

                  <v-col
                    cols="12"
                    class="text-right"
                  >
                    <v-btn
                      color="success"
                      class="mr-0"
                      @click="save"
                    >
                      Update Profile
                    </v-btn>
                  </v-col>
                </v-row>
              </v-container>
            </v-form>
          </base-material-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {
    data: () => ({
      date: new Date(Date.now() - new Date().getTimezoneOffset() * 60000)
        .toISOString()
        .substr(0, 10),
      menu: false,
    }),
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
      save () {
        this.$store
          .dispatch('user/updateDataUser', {
            id: this.users.id,
            firstName: this.users.firstName,
            lastName: this.users.lastName,
            email: this.users.email,
            nickname: this.users.nickName,
            noHp: this.users.noHp,
            homeAddress: this.users.homeAddress,
            dateOfBirth: this.users.dateOfBirth,
            about: this.users.about,
          })
          .then(res => {
            if (res.data.meta.status) {
              const Toast = this.$swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                  toast.addEventListener('mouseenter', this.$swal.stopTimer)
                  toast.addEventListener('mouseleave', this.$swal.resumeTimer)
                },
                popup: 'swal2-show',
                backdrop: 'swal2-backdrop-show',
                icon: 'swal2-icon-show',
              })

              Toast.fire({
                icon: 'success',
                title: 'Data has been successfully created',
              })

              this.$router.push('/user/myaccount')
            }
          })
      },
    },
  }
</script>
