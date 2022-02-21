<template>
  <v-container>
    <v-row>
      <v-col>
        <v-form v-model="invalid">
          <v-row>
            <v-col cols="12">
              <v-text-field
                v-model="data.name"
                :rules="[rules.required]"
                placeholder="Name Studio"
                label="Name Studio"
              />
              <v-textarea
                v-model="data.about"
                :rules="[rules.required]"
                placeholder="About Studio"
                label="About Studio"
              />
              <v-text-field
                v-for="(item, i) in data.url"
                :key="i"
                v-model="item.option"
                :rules="[rules.required]"
                :placeholder="`Link Youtube ${i + 1}`"
                :label="`Url Youtube ke ${i + 1}`"
                :append-icon="mdiCloseActived"
                @click:append="deleteTextField(i)"
              />
              <v-btn
                small
                color="btn_primary"
                @click="addTextFieldUrlYoutube"
              >
                <v-icon>mdi-plus</v-icon>
              </v-btn>
              <v-checkbox
                v-model="term"
                color="green"
              >
                <template v-slot:label>
                  <div class="font-weight-bold">
                    Do you accept the
                    <a href="#">terms</a>
                    and
                    <a href="#">conditions?</a>
                  </div>
                </template>
              </v-checkbox>
            </v-col>
            <v-col cols="12">
              <v-btn
                color="btn_primary"
                :disabled="!invalid || !term"
                @click="methodContinue"
              >
                Continue
              </v-btn>
            </v-col>
          </v-row>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      data: {
        name: "",
        about: "",
        url: [
          {
            option: "",
          },
        ],
      },
      rules: {
        required: (value) => !!value || "Required.",
        min: (v) => (v && v.length >= 8) || "Min 8 characters",
        emailRules: (v) =>
          /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) ||
          "E-mail must be valid",
      },
      invalid: true,
      term: false,
    }),
    computed: {
      mdiCloseActived () {
        return this.data.url.length !== 1 ? "mdi-close" : ""
      },
    },
    methods: {
      methodContinue () {
        this.$emit("continue", { item: this.data })
      },
      deleteTextField (i) {
        if (this.data.url.length > 1) this.data.url.splice(i, 1)
        const Toast = this.$swal.mixin({
          toast: true,
          position: "bottom-end",
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener("mouseenter", this.$swal.stopTimer)
            toast.addEventListener("mouseleave", this.$swal.resumeTimer)
          },
          popup: "swal2-show",
          backdrop: "swal2-backdrop-show",
          icon: "swal2-icon-show",
        })
        Toast.fire({
          icon: "success",
          title: `Text ${i + 1} Delete Succefully`,
        })
      },
      addTextFieldUrlYoutube () {
        this.data.url.push({
          option: "",
        })
      },
    },
  }
</script>

<style></style>
