<template>
  <base-dialog
    :open="dialogAction"
    :icon-system-bar="iconSystemBar"
    :title-system-bar="titleSystemBar"
    :color-system-bar="colorSystemBar"
    @close="dialog.open = false"
  >
    <template #notice>
      <v-container v-if="isTransfer">
        <v-row>
          <v-col class="d-flex justify-center">
            <span
              v-if="dialog.data.class && dialog.data.type === 'live'"
              class="font-spartan"
            >{{ dialog.data.class.name }}</span>
            <span v-else>
              {{ dialog.data.video ? dialog.data.video.name : '-' }}
            </span>
          </v-col>
          <v-col
            cols="12"
            class="d-flex justify-center"
          >
            {{
              dialog.data.to ? dialog.data.to : 'Filled Bank Account Please ..'
            }}
          </v-col>
          <v-col
            class="d-flex justify-center"
            cols="12"
          >
            <v-card width="150">
              <v-img
                width="140"
                height="100"
                gradient="to top right, rgba(0,0,0,.33), rgba(0,0,0,.7)"
                style="cursor: pointer"
                src="https://assets.tokopedia.net/assets-tokopedia-lite/v2/zeus/kratos/62cb37c4.png"
                class="img__hover"
              >
                <template v-slot:placeholder>
                  <v-row
                    class="fill-height ma-0"
                    align="center"
                    justify="center"
                  >
                    <v-progress-circular
                      indeterminate
                      color="grey lighten-5"
                    />
                  </v-row>
                </template>
                <v-container>
                  <v-row>
                    <v-col cols="12">
                      <v-icon
                        large
                        class="mt-5 ml-10 show-btn"
                        color="transparent"
                      >
                        mdi-camera-flip
                      </v-icon>
                    </v-col>
                  </v-row>
                </v-container>
              </v-img>
            </v-card>
          </v-col>
          <v-col
            cols="12"
            class="d-flex justify-center"
          >
            <v-btn
              color="btn_primary"
              @click="uploadImg"
            >
              <v-icon>mdi-camera</v-icon> Send Proof
            </v-btn>
            <v-btn
              color="btn_primary"
              class="ml-2"
            >
              <v-icon>mdi-whatsapp</v-icon> Contact Studio Owner
            </v-btn>
          </v-col>
          <input
            ref="imgButton"
            type="file"
            style="display: none"
            accept="image/*"
            @change="uploadImgFromEnsiklotari"
          >
        </v-row>
      </v-container>
      <v-container v-if="!isDataArray">
        <v-row>
          <v-col cols="12">
            <span class="font-spartan">
              {{ title }}
              {{ dialog.data.class ? dialog.data.class.studio.name : ' - ' }} -
              {{ dialog.data.status }}
            </span>
          </v-col>
          <v-col class="d-flex justify-end">
            <v-btn
              :color="textBtnColor1"
              :text="isTextBtn1"
              @click="actionBtn1"
            >
              {{ textBtn1 }}
            </v-btn>
            <v-btn
              :color="textBtnColor2"
              :text="isTextBtn2"
              @click="actionBtn2"
            >
              {{ textBtn2 }}
            </v-btn>
          </v-col>
        </v-row>
      </v-container>
      <v-container v-if="isDataArray && !isTransfer">
        <v-row v-if="isDataListBank">
          <v-col v-if="dialog.data.class">
            <span class="font-spartan">
              {{ title }}
            </span>
            <div v-if="dialog.data.class.studio && dialog.data.type === 'live'">
              <v-radio-group
                v-model="bank"
                column
              >
                <v-radio
                  v-for="(item, index) in dialog.data.class.studio.bank"
                  :key="index"
                  :label="item.name"
                  :value="item"
                >
                  <template #label>
                    <span>
                      {{ item.name }} - {{ item.no_rek }} - {{ item.bank_name }}
                    </span>
                  </template>
                </v-radio>
              </v-radio-group>
            </div>
          </v-col>
          <v-col v-if="dialog.data.video">
            <span class="font-spartan">
              {{ title }}
            </span>
            <div
              v-if="dialog.data.video.studio && dialog.data.type === 'video'"
            >
              <v-radio-group
                v-model="bank"
                column
              >
                <v-radio
                  v-for="(item, index) in dialog.data.video.studio.bank"
                  :key="index"
                  :value="item"
                >
                  <template #label>
                    <span>
                      {{ item.name }} - {{ item.no_rek }} - {{ item.bank_name }}
                    </span>
                  </template>
                </v-radio>
              </v-radio-group>
            </div>
          </v-col>
          <v-col
            cols="12"
            class="d-flex justify-end"
          >
            <v-btn
              color="red"
              text
              @click="dialog.open = false"
            >
              <v-icon>mdi-close</v-icon>
              cancel
            </v-btn>
            <v-btn
              color="btn_primary"
              @click="actionBank"
            >
              save
            </v-btn>
          </v-col>
        </v-row>
        <v-row v-else>
          <v-col cols="12">
            <span class="font-spartan">
              {{ title }}
            </span>
            <ul>
              <li
                v-for="(item, i) in dialog.data"
                :key="i"
              >
                <span class="font-spartan">
                  {{ item.name }}
                </span>
              </li>
            </ul>
          </v-col>
        </v-row>
      </v-container>
    </template>
  </base-dialog>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
      iconSystemBar: {
        type: String,
        default: null,
      },
      titleSystemBar: {
        type: String,
        default: null,
      },
      colorSystemBar: {
        type: String,
        default: null,
      },
      title: {
        type: String,
        default: null,
      },
      isDataArray: {
        type: Boolean,
        default: true,
      },
      isTransfer: {
        type: Boolean,
        default: false,
      },
      isDataListBank: {
        type: Boolean,
        default: false,
      },
      textBtn1: {
        type: String,
        default: '',
      },
      textBtn2: {
        type: String,
        default: '',
      },
      isTextBtn1: {
        type: Boolean,
        default: false,
      },
      isTextBtn2: {
        type: Boolean,
        default: false,
      },
      textBtnColor1: {
        type: String,
        default: '',
      },
      textBtnColor2: {
        type: String,
        default: '',
      },
    },
    data: () => ({
      bank: null,
    }),
    computed: {
      dialogAction: {
        get () {
          return this.dialog.open
        },
        set () {
          this.dialog.open = !this.dialog.open
        },
      },
    },
    methods: {
      actionClick () {
        this.$emit('actionClick', { item: this.dialog.data })
      },
      actionBtn1 () {
        this.$emit('actionBtn1', { item: this.dialog.data })
      },
      actionBtn2 () {
        this.$emit('actionBtn2', { item: this.dialog.data })
      },
      actionBank () {
        this.$emit('input', { item: this.bank, id: this.dialog.data.id })
      },
      uploadImg () {
        this.$refs.imgButton.click()
      },
      uploadImgFromEnsiklotari (event) {
        this.$emit('upload', { event: event, item: this.dialog.data })
      },
    },
  }
</script>

<style></style>
