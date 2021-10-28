<template>
  <div class="bg--what">
    <v-container class="">
      <v-row>
        <v-col cols="12" md="5">
          <v-carousel class="rounded-lg" v-model="model">
            <v-carousel-item
              v-for="(item, i) in items"
              :key="i"
              :src="item.src"
              reverse-transition="fade-transition"
              transition="fade-transition"
            ></v-carousel-item>
          </v-carousel>
        </v-col>
        <v-col class="d-flex justify-center" cols="12" md="7">
          <v-row>
            <v-col cols="12">
              <span class="font-spartan-text text-h1 mt-6">
                Apa Itu EnsikloTari
              </span>
              <br />
              <br />
              <div class="overflow-scroll">
                <span class="font-spartan-text text-h6 mt-6">
                  Seni Tari selalu identik sebagai bukti keragaman budaya
                  Nusantara. Dari Sabang sampai Merauke, masyarakat Indonesia
                  berekspresi melalui berbagai gerak tari yang atraktif dan
                  menggambarkan keharmonisan bangsa. Selain itu, seni tari pun
                  membawa banyak manfaat untuk kesehatan jasmani dan rohani.
                  Tapi sejujurnya, sejauh apa kita mengenal ragam gerak tari
                  Indonesia ? EnsikloTari akan membawa Anda dalam perjalanan
                  untuk mengembalikan "The Joy Of Dancing".Menemukan ketenangan,
                  that it's OK to not be OK. Para pemula dapat belajar sesuai
                  dengan kecepatan mereka sendiri. Tanpa malu, tanpa ragu. Pintu
                  sanggar terbuka lebar. Anda dapat belajar dari sanggar mana
                  pun, di mana pun, dan di waktu yang Anda mau.
                </span>
              </div>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({
    model: 0,
    colors: ["primary", "secondary", "red", "blue", "orange"],
    items: [
      {
        src: "http://127.0.0.1:8000/images/idTe8IHFxCfVcgKD0UglFQaoG3Z5VPm3jw4hPMOA.jpg",
      },
      {
        src: "https://cdn.vuetifyjs.com/images/carousel/sky.jpg",
      },
      {
        src: "https://cdn.vuetifyjs.com/images/carousel/bird.jpg",
      },
      {
        src: "https://cdn.vuetifyjs.com/images/carousel/planet.jpg",
      },
    ],
  }),
};
</script>

<style lang="sass">
.overflow-scroll
    height: 450px !important
    overflow-y: scroll
    text-justify: justify
    text-align: justify
.bg--what
    background-color: #F4F8FA
</style>>