<template>
  <v-container
    id="google-maps"
    tag="section"
  >
    <v-row>
      <v-col cols="12">
        <base-material-card
          color="success"
          title="Satellite Map"
          class="px-5 py-3"
          icon="mdi-map-marker"
        >
          <v-card-text class="px-0 pb-0">
            <v-sheet>
              <iframe
                src="https://maps.google.com/maps?q=Antapani,%20Jl.%20Terusan%20Sekolah%20No.1-2,%20Cicaheum,%20Kec.%20Kiaracondong,%20Kota%20Bandung,%20Jawa%20Barat%2040282&t=&z=13&ie=UTF8&iwloc=&output=embed"
                width="100%"
                height="450"
                frameborder="0"
                style="border:0"
                allowfullscreen
              />
            </v-sheet>
          </v-card-text>
        </base-material-card>
      </v-col>
    </v-row>
  </v-container>
</template>
