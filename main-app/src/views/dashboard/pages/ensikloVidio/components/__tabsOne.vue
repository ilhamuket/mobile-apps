<template>
  <v-container>
    <v-row>
      <v-col cols="12">
        <div class="d-flex flex-row">
          <div class="d-flex flex-column">
            <span class="font-spartan text-h5 text-capitalize">
              level: {{ data.levels }}
            </span>
          </div>
        </div>
        <div class="d-flex flex-row">
          <div class="d-flex flex-column">
            <span class="font-spartan text-h5">
              Duration: {{ data.duration }} Minutes
            </span>
          </div>
        </div>
        <div class="d-flex flex-row">
          <div class="d-flex flex-column">
            <span
              v-if="data.category"
              class="font-spartan text-h5"
            >
              Category: {{ data.category.display_name }}
            </span>
          </div>
        </div>
        <div class="d-flex flex-row">
          <div class="d-flex flex-column">
            <span class="font-spartan text-h5">
              #About
            </span>
          </div>
        </div>
        <div class="d-flex flex-row">
          <div class="d-flex flex-column">
            <span
              v-if="!isMore && data.about"
              class="mt-2"
            >
              "{{ data.about.substr(0, 100) + "..." }}"
              <span
                class="font-spartan-small ml-1 font-italic"
                style="cursor:pointer"
                @click="isMore = true"
              >More</span>
            </span>
            <span
              v-else
              class="mt-2"
            >
              "{{ data.about }}"
              <span
                class="font-spartan-small ml-1 font-italic"
                style="cursor:pointer"
                @click="isMore = false"
              >Less</span>
            </span>
          </div>
        </div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      isMore: false,
    }),
  }
</script>

<style></style>
