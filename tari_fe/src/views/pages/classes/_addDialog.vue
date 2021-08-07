<template>
  <v-dialog
    v-model="dialog.open"
    width="50%"
  >
    <base-material-card
      icon="mdi-eye"
      class="mt-5"
    >
      <template v-slot:heading>
        <v-chip color="transparent">
          <h3>
            Add Class
          </h3>
        </v-chip>
      </template>

      <v-form class="mt-4">
        <v-text-field
          v-model="form.title"
          label="Input Name"
          placeholder="Name"
          outlined
          dense
        />
        <v-select
          v-model="form.type"
          outlined
          label="Please choose Type"
          dense
          :items="itemsType"
        >
          <template
            slot="selection"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                style="text-transform: capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item }}
              </v-chip>
            </slot>
          </template>
          <template
            slot="item"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                class="text-capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item }}
              </v-chip>
            </slot>
          </template>
        </v-select>
        <v-select
          v-model="form.typeLevelsPost"
          outlined
          label="Please choose Class Levels"
          dense
          :items="itemsTypeClassPost"
        >
          <template
            slot="selection"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                style="text-transform: capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item }}
              </v-chip>
            </slot>
          </template>
          <template
            slot="item"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                class="text-capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item }}
              </v-chip>
            </slot>
          </template>
        </v-select>
        <v-text-field
          v-model="form.url"
          label="Input Url"
          placeholder="Url Youtebe"
          outlined
          dense
        />
        <v-select
          v-model="form.instructor_id"
          placeholder="Instructor"
          label="Please choose Instructor"
          outlined
          dense
          :items="instructor"
          item-text="firstName"
          item-value="id"
        >
          <template
            slot="selection"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                style="text-transform: capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://eshendetesia.com/images/user-profile.png"
                  />
                </v-avatar>
                {{ data.item.firstName + ' ' + data.item.lastName }}
              </v-chip>
            </slot>
          </template>
          <template
            slot="item"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                class="text-capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://eshendetesia.com/images/user-profile.png"
                  />
                </v-avatar>
                {{ data.item.firstName + ' ' + data.item.lastName }}
              </v-chip>
            </slot>
          </template>
        </v-select>
        <v-select
          v-model="form.status"
          label="Please choose Status"
          placeholder="Status"
          outlined
          dense
          :items="itemsStatus"
        >
          <template
            slot="selection"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                style="text-transform: capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item }}
              </v-chip>
            </slot>
          </template>
          <template
            slot="item"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                class="text-capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item }}
              </v-chip>
            </slot>
          </template>
        </v-select>

        <v-select
          v-model="form.category_id"
          outlined
          label="Please choose Category"
          placeholder="Category"
          dense
          :items="category"
          item-value="id"
        >
          <template
            slot="selection"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                style="text-transform: capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item.name }}
              </v-chip>
            </slot>
          </template>
          <template
            slot="item"
            slot-scope="data"
          >
            <slot
              name="item"
              v-bind="data"
            >
              <v-chip
                color="transparent"
                class="text-capitalize"
              >
                <v-avatar left>
                  <v-img
                    src="https://sumedangtandang.com/upload/logo/logo_259.jpg"
                  />
                </v-avatar>
                {{ data.item.name }}
              </v-chip>
            </slot>
          </template>
        </v-select>

        <div class="d-flex flex-row-reverse">
          <div class="d-flex-flex-column">
            <v-btn
              color="red"
              outlined
              class="mr-2"
              @click="dialog.open = false"
            >
              Close
            </v-btn>
            <v-btn
              color="pallet1"
              outlined
              @click="send"
            >
              Save
            </v-btn>
          </div>
        </div>
      </v-form>
    </base-material-card>
  </v-dialog>
</template>

<script>
  export default {
    props: {
      dialog: {
        type: Object,
        default: null,
      },
      instructor: {
        type: Array,
        default: null,
      },
      category: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      itemsStatus: ['publish', 'preview', 'concept'],
      itemsType: ['Live Class', 'Playlist'],
      itemsTypeClassPost: ['beginner', 'intermediate', 'advanced'],
      form: {
        title: '',
        type: '',
        url: '',
        instructor_id: null,
        status: '',
        category_id: null,
        typeLevelsPost: '',
      },
    }),
    methods: {
      send () {
        this.$emit('send', { item: this.form })
      },
    },
  }
</script>
<style lang="sass" scoped>
.overflow-hidden
  overflow-y: hidden !important
</style>
