<template>
  <div>
    Date :
    {{ data.start_at | moment('MMMM Do YYYY') }}
    <br>
    {{ data.time_start }} s/d {{ data.time_end }}
    <br>
    Levels :
    <span class="ml-2">{{ data.levels }}</span>
    <br>
    Duration : <span class="ml-2">{{ data.durasi }} Minutes</span>
    <br>
    Category :
    <span
      v-if="data.category"
      class="ml-2 btn_primary--text"
    >
      {{ data.category.display_name }}
    </span>
    <br>
    <v-chip
      class="mt-1"
      label
      outlined
      color="primary"
    >
      Capacity: <span class="ml-2">0 / {{ data.kapasitas }} </span>
    </v-chip>
    <br>
    #About Class:
    <br>
    <span
      v-if="!isMore && data.about"
      class="mt-2"
    >
      "{{ data.about.substr(0, 100) + '...' }}"
      <span
        class="font-spartan-small ml-1 font-weight-bold"
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
        class="font-spartan-small ml-1 font-weight-bold"
        style="cursor:pointer"
        @click="isMore = false"
      >Less</span>
    </span>
  </div>
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
