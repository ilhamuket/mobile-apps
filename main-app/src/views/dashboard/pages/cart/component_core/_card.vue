<template>
  <v-row id="card">
    <v-col cols="4">
      <v-checkbox
        v-model="allSelected"
        class="checkbox__choice"
        @click="selectAll"
      >
        <template v-slot:label>
          <span
            class="font-spartan-small mt-1 font-weight-bold text-capitalize"
            :class="$vuetify.theme.dark ? 'white--text' : 'black--text'"
          >
            choose all
          </span>
        </template>
      </v-checkbox>
    </v-col>
    <v-col
      v-if="allSelected"
      cols="8"
      class="margin__cart d-flex justify-end"
    >
      <div>
        <span class="font-spartan-small btn_primary--text">
          Move to wisList |
        </span>
        <span class="font-spartan-small btn_primary--text">
          Delete
        </span>
      </div>
    </v-col>

    <v-col
      v-for="(item, i) in data"
      :key="i"
      cols="12"
      class="mb-7"
    >
      <v-list class="list__cart card__list--hover">
        <v-list-item>
          <v-checkbox
            v-model="checkbox[i]"
            :value="data[i].type"
            class="checkbox__choice__body"
            @click="selectIndex(data[i])"
          >
            <template v-slot:label>
              <span
                class="font-spartan mt-1 font-weight-bold text-capitalize"
              />
            </template>
          </v-checkbox>
          <v-list-item-title
            v-if="item.class"
            class="font-spartan"
          >
            <span class="mt-2 font-spartan text-capitalize">{{
              item.class.studio.name
            }}</span>
            <br>
            <span class="font-spartan-small">
              {{ item.class.category.display_name }}
            </span>
          </v-list-item-title>
        </v-list-item>
        <v-list-item>
          <v-row v-if="item.class">
            <v-col
              cols="12"
              md="2"
              sm="12"
            >
              <v-img
                class="ml-8"
                width="69"
                height="69"
                :src="item.class.img.url"
              />
            </v-col>
            <v-col
              cols="12"
              md="8"
            >
              <span>
                {{ item.class.name }}
                <v-chip
                  color="transparent"
                  text-color="red"
                  class="text-capitalize"
                >{{ item.class.status_kelas }}</v-chip>
              </span>
              <br>
              <span>Rp{{ item.class.harga }}
                <v-rating
                  v-model="rating"
                  class="rating__cart"
                  background-color="grey"
                  color="orange"
                  small
                />
              </span>
              <span
                class="font-spartan-small btn_primary--text card--hover action__card"
                style="cursor:pointer"
              >Move to wistlish |
                <v-icon class="icon__delete--margin">
                  mdi-trash-can-outline
                </v-icon>
              </span>
            </v-col>
          </v-row>
        </v-list-item>
      </v-list>
    </v-col>
    <v-divider class="mb-2 mt-2" />
  </v-row>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
    },
    data () {
      return {
        checkbox: [],
        rating: 3,
        allSelected: false,
        userIds: [],
      }
    },
    mounted () {},
    methods: {
      selectAll () {
        this.userIds = []

        if (this.allSelected) {
          for (const user in this.data) {
            this.userIds.push(this.data[user])
            this.checkbox = true
            console.log(this.userIds)
          }
        } else {
          this.checkbox = false
        }
      },
      selectIndex (i) {
        console.log(this.checkbox)
        if (this.checkbox) {
          this.userIds.push(i)
          console.log(this.userIds)
        } else {
          const index = this.userIds.findIndexP(x => x.id === i.id)
          console.log(index)
        }
      },
    },
  }
</script>

<style lang="sass">
#card
  .font-spartan
    font-weight: 900
.checkbox__choice
    margin-left: 17px
    .v-input__control .v-input__slot
        .v-input--selection-controls__input
            .v-icon
                font-size: 20px

.checkbox__choice__body
    .v-input__control .v-input__slot
        .v-input--selection-controls__input
            .v-icon
                font-size: 26px
                margin-top: -24px
.margin__cart
  margin-top: 28px
.list__cart
    margin-top: -40px
    border-bottom: 2px double white !important
    .rating__cart
        margin-left: -9px
        margin-top: -8px
.margin__text__delete
    margin-left: 672px
    margin-top: -38px
    margin-bottom: 15px !important
.card__list--hover
    .card--hover
        opacity: 0
    .icon__delete--margin
        margin-left: 3px
.card__list--hover
    &:hover
         .card--hover
            opacity: 1
.theme--dark
    .bg__checkbox
        background-color: #283046
        width: 300px !important
</style>
<style lang="sass" scoped>
.theme--light
    .v-list
        background-color: #f0f2f5 !important
.theme--dark
    .v-sheet
        background: #283046 !important
    .v-list .v-list-item
        background-color: #283046 !important
</style>
