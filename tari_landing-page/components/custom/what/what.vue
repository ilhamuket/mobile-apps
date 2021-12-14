<template>
  <div class="bg--fitur1">
    <v-container class="">
      <v-row class="container--what">
        <v-col cols="12" md="5">
          <v-carousel class="rounded-lg" v-model="model">
            <v-carousel-item
              :src="require('@/assets/images/breadcumb/img1.png')"
              reverse-transition="fade-transition"
              transition="fade-transition"
            ></v-carousel-item>
            <v-carousel-item
              :src="require('@/assets/images/breadcumb/img2.png')"
              reverse-transition="fade-transition"
              transition="fade-transition"
            ></v-carousel-item>
            <v-carousel-item
              :src="require('@/assets/images/breadcumb/img3.jpg')"
              reverse-transition="fade-transition"
              transition="fade-transition"
            ></v-carousel-item>
          </v-carousel>
        </v-col>
        <v-col class="d-flex justify-center" cols="12" md="6">
          <v-row>
            <v-col cols="12">
              <span
                class="
                  font-spartan-text font-weight-bold text-h1
                  mt-6
                "
              >
                Apa Itu EnsikloTari
              </span>
              <br />
              <br />
              <div class="overflow-scroll">
                <span
                  class="font-spartan-text width--text text-h6 mt-6 black--text"
                >
                  Seni Tari selalu identik sebagai bukti keragaman budaya
                  Nusantara. Dari Sabang sampai Merauke, masyarakat Indonesia
                  berekspresi melalui berbagai gerak tari yang atraktif dan
                  menggambarkan keharmonisan bangsa. Selain itu, seni tari pun
                  membawa banyak manfaat untuk kesehatan jasmani dan rohani.
                  Tapi sejujurnya, sejauh apa kita mengenal ragam gerak tari
                  Indonesia ? EnsikloTari akan membawa Anda dalam perjalanan
                  untuk mengembalikan
                  <span class="font-italic">The Joy Of Dancing</span>.Menemukan
                  ketenangan,
                  <span class="font-italic">that it's OK to not be OK.</span>
                  Para pemula dapat belajar sesuai dengan kecepatan mereka
                  sendiri. Tanpa malu, tanpa ragu. Pintu sanggar terbuka lebar.
                  Anda dapat belajar dari sanggar mana pun, di mana pun, dan di
                  waktu yang Anda mau.
                </span>
              </div>
            </v-col>
          </v-row>
        </v-col>
      </v-row>
      <!-- <v-row>
        <v-col cols="12" md="4">
          <v-card>
            <v-avatar>
              <v-img />
            </v-avatar>
            <v-card-text>
              
            </v-card-text>
          </v-card>
        </v-col>
      </v-row> -->
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
        src: "",
      },
      {
        src: "@/assets/images/breadcumb/img2.png",
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
  /* width */
::-webkit-scrollbar
  width: 6px

/* Track */
::-webkit-scrollbar-track
  background: #f1f1f1

/* Handle */
::-webkit-scrollbar-thumb
  background: #888

/* Handle on hover */
::-webkit-scrollbar-thumb:hover
  background: #555
  .width--text
    width: 100% !important
.bg--what
  background-color: #F4F8FA
.container--what
  margin-top: 2%
  margin-bottom: 2%
.primary--text1
  color: #9DC5D1 !important
.font-italic
  font-style: italic
</style>>