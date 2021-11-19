<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        lg="6"
      >
        <base-material-stats-card
          color="primary"
          icon="mdi-twitter"
          :title="$t('classes')"
          :value="String(summary.classes)"
          sub-icon="mdi-heart-outline"
          sub-text="EnsikloTari"
          style="cursor:pointer"
          @click.native="toNavigate('/class')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="6"
      >
        <base-material-stats-card
          color="primary"
          icon="mdi-twitter"
          :title="$t('category')"
          :value="String(summary.category)"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
          style="cursor:pointer"
          @click.native="toNavigate('/category')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="6"
      >
        <base-material-stats-card
          color="primary"
          icon="mdi-account-group-outline"
          :title="$t('vidio_name_page')"
          :value="String(summary.vidio_profile)"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
          style="cursor:pointer"
          @click.native="toNavigate('/vidio')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="6"
      >
        <base-material-stats-card
          color="primary"
          icon="mdi-account-cowboy-hat-outline"
          :title="$t('instrucktur')"
          :value="String(summary.instructor)"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
          style="cursor:pointer"
          @click.native="toNavigate('/instructor')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="6"
      >
        <base-material-stats-card
          color="primary"
          icon="mdi-account-cowboy-hat-outline"
          :title="$t('discusses')"
          :value="String(summary.discuss)"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
          style="cursor:pointer"
          @click.native="navigateTabs('discussion')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="6"
      >
        <base-material-stats-card
          color="primary"
          icon="mdi-account-cowboy-hat-outline"
          :title="$t('reviews')"
          :value="String(summary.reviews)"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
          style="cursor:pointer"
          @click.native="navigateTabs('reviews')"
        />
      </v-col>
      <v-col
        cols="12"
        lg="6"
      >
        <base-material-stats-card
          color="primary"
          icon="mdi-account-cowboy-hat-outline"
          :title="$t('bank_account')"
          :value="String(summary.bank_account)"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
          style="cursor:pointer"
          @click.native="navigateTabs('bank-account')"
        />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      summary: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      tabs: 0,
    }),
    methods: {
      toNavigate (link) {
        this.$router.push(link)
      },
      navigateTabs (tabs) {
        this.$emit("navigate", { item: tabs })
      },
    },
  }
</script>

<style></style>
