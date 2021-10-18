<template>
  <v-container>
    <v-card-title class="font-spartan font-weight-bold">
      Reviews
    </v-card-title>
    <v-row class="ml-2">
      <v-col
        cols="12"
        sm="6"
        lg="4"
      >
        <v-card
          class="mt-5"
          height="120"
        >
          <v-card-text class="">
            <span
              class="font-spartan ratings__modified btn_primary--text d-flex justify-center"
            >
              4.6
            </span>
            <br>
            <span
              class="font-spartan font__users_rating btn_primary--text d-flex justify-center"
            >
              dari 620 User
            </span>
          </v-card-text>
        </v-card>
      </v-col>
      <v-col
        cols="12"
        sm="6"
        lg="7"
      >
        <div>
          <v-rating
            :value="5"
            color="btn_primary"
            length="1"
            half-increments
            readonly
          >
            <template v-slot:item="props">
              <v-icon
                :color="'btn_primary'"
                medium
                @click="props.click"
              >
                mdi-star-circle
              </v-icon>
              <span>5</span>
            </template>
          </v-rating>
          <v-progress-linear
            class="progres--ratings"
            :value="skill"
            color="primary"
            height="9"
            readonly
            rounded
          />

          <br>

          <v-rating
            :value="5"
            color="btn_primary"
            length="1"
            half-increments
            readonly
          >
            <template v-slot:item="props">
              <v-icon
                :color="'btn_primary'"
                medium
                @click="props.click"
              >
                mdi-star-circle
              </v-icon>
              <span>4</span>
            </template>
          </v-rating>
          <v-progress-linear
            class="progres--ratings"
            :value="skill"
            color="primary"
            height="9"
            readonly
            rounded
          />

          <br>

          <v-rating
            :value="5"
            color="btn_primary"
            length="1"
            half-increments
            readonly
          >
            <template v-slot:item="props">
              <v-icon
                :color="'btn_primary'"
                medium
                @click="props.click"
              >
                mdi-star-circle
              </v-icon>
              <span>3</span>
            </template>
          </v-rating>
          <v-progress-linear
            class="progres--ratings"
            :value="skill"
            color="primary"
            height="9"
            readonly
            rounded
          />

          <br>

          <v-rating
            :value="5"
            color="btn_primary"
            length="1"
            half-increments
            readonly
          >
            <template v-slot:item="props">
              <v-icon
                :color="'btn_primary'"
                medium
                @click="props.click"
              >
                mdi-star-circle
              </v-icon>
              <span>2</span>
            </template>
          </v-rating>
          <v-progress-linear
            class="progres--ratings"
            :value="skill"
            color="primary"
            height="9"
            readonly
            rounded
          />

          <br>

          <v-rating
            :value="5"
            color="btn_primary"
            length="1"
            half-increments
            readonly
          >
            <template v-slot:item="props">
              <v-icon
                :color="'btn_primary'"
                medium
                @click="props.click"
              >
                mdi-star-circle
              </v-icon>
              <span>1</span>
            </template>
          </v-rating>
          <v-progress-linear
            class="progres--ratings"
            :value="skill"
            color="primary"
            height="9"
            readonly
            rounded
          />
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      skill: 90,
      knowledge: 33,
      power: 78,
    }),
  }
</script>

<style lang="sass">
.progres--ratings
    margin-left: 50px
    margin-top: -20px
</style>
