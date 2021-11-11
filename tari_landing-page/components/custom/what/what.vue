<template>
  <div class="bg--what">
    <v-container class="">
      <v-row class="container--what">
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
              <span
                class="
                  font-spartan-text font-weight-bold
                  primary--text1
                  text-h1
                  mt-6
                "
              >
                Apa Itu EnsikloTari
              </span>
              <br />
              <br />
              <div class="overflow-scroll">
                <span class="font-spartan-text text-h6 mt-6 grey--text">
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
        src: "https://api.ensiklotari.com/images/category/fiNBaPXYNLwbOhdcwbskT0MAPXVIOI2d03XOSh4O.jpg",
      },
      {
        src: "https://api.ensiklotari.com/images/category/o3LmUXaA2hGa192ycyAbcF1GDrN1sAXEU4XXBZGJ.jpg",
      },
      {
        src: "https://api.ensiklotari.com/images/category/0cOKASyNfM6rjHWftIZ9pS3UkDczINdZjSMkPWXm.jpg",
      },
    ],
  }),
};
</script>

<style lang="sass">
.overflow-scroll
  height: 450px !important
  overflow-y: auto
  text-justify: justify
  text-align: justify
  width: 120%
.bg--what
  background-color: #F4F8FA
.container--what
  margin-top: 2%
  margin-bottom: 2%
.primary--text1
  color: #9DC5D1 !important
</style>>