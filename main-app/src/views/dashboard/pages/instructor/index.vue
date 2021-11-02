<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <div
          v-if="isLoading"
          class="d-flex justify-center"
        >
          <v-progress-circular
            class="d-flex justify-center"
            indeterminate
            color="red"
          />
        </div>

        <div v-if="computedInstructor.length !== 0">
          <app-card :data="computedInstructor" />
        </div>

        <div
          v-else
          class="d-flex justify-center"
        >
          <v-img
            width="900"
            height="400"
            src="@/assets/img/noclass.svg"
          />
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  import listCard from "./component_core/_listCard.vue"
  export default {
    components: {
      "app-card": listCard,
    },
    data: () => ({
      isLoading: true,
    }),
    computed: {
      computedInstructor () {
        return this.$store.state.instructor.data
      },
    },
    mounted () {
      this.getInstructor()
    },
    methods: {
      getInstructor () {
        this.$store
          .dispatch("instructor/getInstructor", {
            entities: "img,studio",
            status: 1,
          })
          .then((res) => {
            if (res.data.meta.status) {
              this.isLoading = false
            }
          })
      },
    },
  }
</script>

<style></style>
