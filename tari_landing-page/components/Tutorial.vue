<template>
  <div>
    <v-container>
      <v-row>
        <v-col cols="12">
          <v-card class="rounded-lg">
            <iframe
              width="1100"
              height="545"
              class="rounded-lg"
              src="https://www.youtube.com/embed/kRR-MvDMxIg"
            >
            </iframe>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <span class="font-spartan-text text-capitalize">
                      Cara Pendaftaran dan Pembelian kelas di ensiklotari
                    </span>
                  </v-col>
                  <v-col cols="12"><span>Deskripsi</span></v-col>
                  <v-col cols="12">{{
                    boolean ? text.substr(0, 110) + "..." : text
                  }}</v-col>
                  <v-col cols="12"
                    ><v-chip
                      @click="boolean = !boolean"
                      style="cursor: pointer"
                      color="transparent"
                    >
                      {{ boolean ? "Lebih Banyak" : "lebih sedikit" }}
                    </v-chip></v-col
                  >
                </v-row>
              </v-container>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="8">
          <v-container>
            <v-col cols="12">
              <span class="font-weight-bold text-h4"> Diskusi (0) </span>
            </v-col>
            <v-col>
              <v-text-field
                label="Diskusi"
                placeholder="Diskusi sebagai tamu"
                append-icon="mdi-send"
              >
                <template #prepend>
                  <v-avatar>
                    <v-img src="https://picsum.photos/1920/1080?random"></v-img>
                  </v-avatar>
                </template>
              </v-text-field>
            </v-col>
          </v-container>
        </v-col>
        <v-col cols="12" md="4">
          <v-container>
            <v-row>
              <v-col cols="12"> Filter </v-col>
              <v-col ref="row" cols="12" class="cols__chips text-nowrap">
                <v-chip>Tutorial bala</v-chip>
                <v-chip>Tutorial bala</v-chip>
                <v-chip>Tutorial bala</v-chip>
                <v-chip>Tutorial bala</v-chip>
              </v-col>

            </v-row>
          </v-container>
          <v-list max-height="550" class="overflow-y-auto">
            <v-list-item>
              <v-list-item-content>
                <v-card>
                  <v-img
                    width="400"
                    height="200"
                    src="https://i.ytimg.com/vi/B1cDwfxs1VM/hqdefault.jpg"
                  />
                  <div class="d-flex flex-row justify-start mt-4">
                    <div class="d-flex flex-column">
                      <p class="ml-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing.
                      </p>
                    </div>
                  </div>
                  <div class="d-flex flex-row justify-center ml-2">
                    <div class="d-flex flex-column">
                      <p class="grey--text">
                        <v-icon class="mr-2">mdi-heart-outline</v-icon
                        >EnsikloTari
                      </p>
                    </div>
                  </div>
                </v-card>
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <v-card>
                  <v-img
                    width="400"
                    height="200"
                    src="https://i.ytimg.com/vi/B1cDwfxs1VM/hqdefault.jpg"
                  />
                  <div class="d-flex flex-row justify-start mt-4">
                    <div class="d-flex flex-column">
                      <p class="ml-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing.
                      </p>
                    </div>
                  </div>
                  <div class="d-flex flex-row justify-center ml-2">
                    <div class="d-flex flex-column">
                      <p class="grey--text">
                        <v-icon class="mr-2">mdi-heart-outline</v-icon
                        >EnsikloTari
                      </p>
                    </div>
                  </div>
                </v-card>
              </v-list-item-content>
            </v-list-item>
            <v-list-item>
              <v-list-item-content>
                <v-card>
                  <v-img
                    width="400"
                    height="200"
                    src="https://i.ytimg.com/vi/B1cDwfxs1VM/hqdefault.jpg"
                  />
                  <div class="d-flex flex-row justify-start mt-4">
                    <div class="d-flex flex-column">
                      <p class="ml-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing.
                      </p>
                    </div>
                  </div>
                  <div class="d-flex flex-row justify-center ml-2">
                    <div class="d-flex flex-column">
                      <p class="grey--text">
                        <v-icon class="mr-2">mdi-heart-outline</v-icon
                        >EnsikloTari
                      </p>
                    </div>
                  </div>
                </v-card>
              </v-list-item-content>
            </v-list-item>
          </v-list>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  props: {
    data: {
      type: Object,
      default: null
    }
  },
  data: () => ({
    page: "",
    text: `Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                    Cumque minima consequuntur fuga eligendi. Praesentium
                    molestias minima amet possimus odio non! Eaque eum deserunt
                    magnam at doloribus adipisci a architecto illo molestiae,
                    dolorem omnis nostrum molestias facere eligendi ipsa ab
                    accusantium similique, sequi expedita. Alias, perferendis
                    aspernatur. Expedita, possimus velit placeat, sequi
                    repellendus non obcaecati quaerat saepe dolorum veritatis
                    ipsum animi sed vitae neque aliquid, blanditiis optio
                    ratione voluptatum deleniti magni cupiditate. Iste est eos
                    autem similique aspernatur sint iure! Pariatur ullam quia
                    incidunt ipsum possimus impedit ratione repellendus id
                    numquam eaque enim necessitatibus deleniti quos delectus vel
                    dolore, aperiam reprehenderit?`,

    boolean: true,
  }),
  mounted() {
  },

  left() {
    this.$refs.row.scrollLeft - 20;
  },
};
</script>

<style lang="sass">
.margin--btnIcon
  margin-top: -2%
.cols__chips
  overflow-x: auto
.margin--customes--left
  margin-top: 4%
  margin-left: -110%
</style>