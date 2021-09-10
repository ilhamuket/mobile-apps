<template>
  <v-container>
    <v-dialog
      v-model="dialog.open"
      width="90%"
    >
      <v-card>
        <v-card-title class="text-h2 pallet1--text font-title-rampart-one">
          Add Class

          <v-spacer />

          <v-icon
            aria-label="Close"
            @click="dialog.open = false"
          >
            mdi-close
          </v-icon>
        </v-card-title>
        <v-container>
          <v-row>
            <v-col>
              <v-select
                v-model="formStatus"
                label="Status"
                prepend-icon="mdi-alpha-s-box"
                :items="status"
              />
            </v-col>
            <v-col
              v-for="(n, i) in data"
              :key="i"
              cols="12"
            >
              <v-text-field
                v-model="n.option"
                label="Url Youtube"
                placeholder="Url"
                prepend-icon="mdi-youtube"
                append-icon="mdi-close"
                @click:append="deleteInput(i)"
              />
            </v-col>
            <v-col>
              <v-tooltip
                bottom
                color="primary"
              >
                <template #activator="{on, attrs}">
                  <v-btn
                    v-bind="attrs"
                    icon
                    dark
                    large
                    v-on="on"
                    @click="addText"
                  >
                    <v-icon
                      color="primary"
                      dark
                    >
                      mdi-plus
                    </v-icon>
                  </v-btn>
                </template>
                <span>Add Url</span>
              </v-tooltip>
            </v-col>
          </v-row>
          <div class="d-flex flex-row-reverse">
            <div class="d-flex flex-column">
              <v-btn
                color="primary"
                @click="addVidio"
              >
                Create
              </v-btn>
            </div>
            <div class="d-flex flex-column">
              <v-btn
                text
                color="red"
                @click="dialog.open = false"
              >
                Cancel
              </v-btn>
            </div>
          </div>
        </v-container>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
    },
    data: () => ({
      data: [
        {
          option: '',
        },
      ],
      formStatus: '',
      status: ['publish', 'previews', 'concept'],
    }),
    methods: {
      addText () {
        this.data.push({ option: '' })
      },
      deleteInput (index) {
        if (index > 0 || this.data.length > 1) {
          this.data.splice(index, 1)
          const Toast = this.$swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: toast => {
              toast.addEventListener('mouseenter', this.$swal.stopTimer)
              toast.addEventListener('mouseleave', this.$swal.resumeTimer)
            },
            popup: 'swal2-show',
            backdrop: 'swal2-backdrop-show',
            icon: 'swal2-icon-show',
          })
          Toast.fire({
            icon: 'success',
            title: 'Deleted Successfully',
          })
        } else {
          const Toast = this.$swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: toast => {
              toast.addEventListener('mouseenter', this.$swal.stopTimer)
              toast.addEventListener('mouseleave', this.$swal.resumeTimer)
            },
            popup: 'swal2-show',
            backdrop: 'swal2-backdrop-show',
            icon: 'swal2-icon-show',
          })
          Toast.fire({
            icon: 'error',
            title: 'Failed filled first',
          })
        }
      },
      addVidio () {
        this.$emit('input', {
          item: {
            url: this.data,
            status: this.formStatus,
          },
        })
      },
    },
  }
</script>

<style lang="sass"></style>
