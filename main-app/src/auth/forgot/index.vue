<template>
  <v-app class="bg--login">
    <v-container>
      <v-row
        align="center"
        class="mt-12 d-flex justify-center align-center"
      >
        <v-col
          class="d-flex justify-center align-center row--custome"
          cols="12"
        >
          <v-col
            cols="12"
            md="8"
            class=""
          >
            <v-card>
              <v-card-text>
                <span class="font-spartan ml-6 margin--text">
                  Lupa Kata Sandi
                </span>
              </v-card-text>
              <v-container>
                <v-form>
                  <v-row>
                    <v-col
                      class="mt-6"
                      cols="12"
                    >
                      <v-text-field
                        prepend-icon="mdi-at"
                        placeholder="Masukan Email"
                        label="E-mail"
                      />
                    </v-col>
                  </v-row>
                  <v-row>
                    <v-col
                      class="d-flex flex-row-reverse"
                      cols="12"
                    >
                      <v-btn color="btn_primary">
                        Lanjutkan
                      </v-btn>
                    </v-col>
                  </v-row>
                </v-form>
              </v-container>
            </v-card>
          </v-col>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {}
</script>

<style lang="sass">
.bg--login
  background-color: #843839 !important
.margin--text
    align-content: center !important
</style>
