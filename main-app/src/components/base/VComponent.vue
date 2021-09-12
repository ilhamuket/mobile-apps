<template>
  <section class="mb-12 text-center">
    <h1 class="font-spartan font-italic primary--text">
      History Class
    </h1>

    <!-- <span class="font-weight-light ">
      Please checkout the
      <a
        :href="`https://vuetifyjs.com/${link}`"
        rel="noopener"
        target="_blank"
        class="secondary--text"
        style="text-decoration:none;"
      >
        full documentation
      </a>
    </span> -->
  </section>
</template>

<script>
  export default {
    name: 'VComponent',

    props: {
      heading: {
        type: String,
        default: '',
      },
      link: {
        type: String,
        default: '',
      },
    },
  }
</script>
