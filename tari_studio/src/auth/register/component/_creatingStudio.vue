<template>
  <v-card class="mb-12">
    <v-container>
      <v-form v-model="invalid">
        <v-row>
          <v-col>
            <v-text-field
              v-model="fullNameStudio"
              :rules="[rules.required]"
              label="Name Studio"
              prepend-icon="mdi-alpha-n-circle-outline"
            />
            <v-text-field
              v-model="data.email"
              :rules="[rules.required]"
              label="Email Studio"
              prepend-icon="mdi-at"
            />
            <v-text-field
              v-model="data.phoneNumber"
              :rules="[rules.required]"
              label="Contact Studio"
              prepend-icon="mdi-alpha-p-circle-outline"
            />
            <v-textarea
              v-model="step2.data.about"
              :rules="[rules.required]"
              label="About Studio"
              prepend-icon="mdi-alpha-p-circle-outline"
            />
            <!-- <v-file-input
              v-model="files"
              show-size
              :loading="upload_state"
              :disabled="disable_state"
              accept="image/png, image/jpeg, image/bmp"
              prepend-icon="mdi-camera"
              placeholder="Upload Thumbnail"
              @change="change(files)"
            /> -->
            <div
              v-for="(item, i) in step2.data.options"
              :key="i"
            >
              <v-text-field
                v-model="item.option"
                :rules="[rules.required]"
                label="Url"
                :placeholder="'Url ke-' + (i + 1)"
                type="text"
                prepend-icon="mdi-youtube"
                append-icon="mdi-close"
                @keyup="createNewInput(i)"
                @click:append="deleteInput(i)"
              />
            </div>
          </v-col>
        </v-row>
        <v-btn
          color="primary"
          :disabled="!invalid"
          @click="nextStep"
        >
          Continue
        </v-btn>

        <v-btn text>
          Cancel
        </v-btn>
      </v-form>
    </v-container>
  </v-card>
</template>

<script>
  export default {
    props: {
      data: {
        type: Object,
        default: () => ({
          firstName: 'Studio',
          lastName: 'Bagus',
        }),
      },
    },
    data: () => ({
      step2: {
        data: {
          about: '',

          options: [
            {
              option: '',
            },
          ],
        },
      },
      rules: {
        required: value => !!value || 'Required.',
        min: v => (v && v.length >= 8) || 'Min 8 characters',
        emailRules: v =>
          /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          'E-mail must be valid',
      },
      invalid: true,
      upload_state: false,
      disable_state: false,
      files: null,
    }),
    computed: {
      fullNameStudio: {
        get () {
          return this.data.firstName + ' ' + this.data.lastName
        },
        set (val) {
          return val
        },
      },
      prefixStudio () {
        const fullname = this.fullNameStudio.split(' ')
        const prefix = fullname.shift().charAt(0) + fullname.pop().charAt(0)
        return prefix
      },
    },
    methods: {
      nextStep () {
        this.$emit('next', {
          item: {
            data: {
              item1: this.step2,
              item2: this.data,
              fullnameStudio: this.fullNameStudio,
              prefix: this.prefixStudio,
            },
          },
        })
      },
      createNewInput (index) {
        if (index > 0 && this.step2.data.options.length > 1) {
          if (this.step2.data.options.length === index + 1) {
            this.step2.data.options.push({ option: '' })
          } else if (
            this.step2.data.options[index + 1].option !== '' &&
            this.step2.data.options.length === index + 1
          ) {
            this.step2.data.options.push({ option: '' })
          }
        } else if (index >= 0 && this.step2.data.options.length === 1) {
          this.step2.data.options.push({ option: '' })
        }
      },
      theFirst () {
        if (this.step2.data.options.length === 0) {
          this.step2.data.options.push({ option: '' })
        }
      },
      deleteInput (index) {
        if (index > 0 || this.step2.data.options.length > 1) {
          this.step2.data.options.splice(index, 1)
        }
      },
      change (files) {
        if (files === null) {
          this.upload_state = false
          this.disable_state = false
          return 1
        }
        console.log(this.files)
        this.$emit('inputFiles', { item: files })
      },
    },
  }
</script>

<style></style>
