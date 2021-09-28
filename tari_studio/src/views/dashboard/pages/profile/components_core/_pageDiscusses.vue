<template>
  <v-container>
    <v-row class="mt-5">
      <v-col
        cols="12"
        md="4"
      >
        <v-text-field
          :label="$t('search')"
          :placeholder="$t('type')"
          append-icon="mdi-magnify"
        />
      </v-col>
      <v-col
        cols="8"
        class="d-flex flex-row-reverse mt-4"
      >
        <v-btn
          outlined
          rounded
          small
          dark
          color="primary"
          @click="refreshMethods"
        >
          <v-icon color="size__icon_refresh">
            mdi-cached
          </v-icon>
        </v-btn>
      </v-col>
      <v-col cols="12">
        <v-data-table
          :items="data"
          :headers="headers"
          show-select
          mobile-breakpoint="0"
        >
          <template #[`header.class.name`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.body`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.user.firstName`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.child.firstName`]="{ header }">
            {{ $t(header.text) }}
          </template>
          <template #[`header.likes`]="{ header }">
            {{ $t(header.text) }}
          </template>

          <!-- Items -->
          <template #[`item.id`]="{item}">
            <v-avatar
              tile
              size="90"
            >
              <v-img
                v-if="item.class"
                :src="item.class.img.url"
              />
            </v-avatar>
          </template>
          <template #[`item.class.name`]="{item}">
            <div class="mt-6">
              {{ item.class.name }}
            </div>
            <div class="bg-hover">
              <div class="d-flex flex-row flex-nowrap">
                <!-- <div>
                  <div class="d-flex flex-column flex-nowrap mt-2">
                    <a
                      class="font-a d-flex flex-nowrap"
                      @click="upDialogeditClass(item)"
                    >
                      <v-icon
                        small
                        color="blue"
                        class="mr-1"
                      >
                        mdi-pencil
                      </v-icon>
                      Edit
                    </a>
                  </div>
                </div> -->
                <div>
                  <div class="d-flex flex-column mt-2 ml-1 mr-1">
                    <a
                      class="d-flex blue--text flex-nowrap"
                      @click="reply(item)"
                    >
                      <v-icon
                        color="blue"
                        small
                        class="mr-1"
                      >
                        mdi-reply-all-outline
                      </v-icon>
                      Reply
                    </a>
                  </div>
                </div>
                <div>
                  <div class="d-flex flex-column mt-2">
                    <a
                      class="font-a-delete d-flex flex-nowrap"
                      @click="deleteDiscuss(item)"
                    >
                      <v-icon
                        color="red"
                        small
                      >
                        mdi-delete
                      </v-icon>
                      Delete
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </template>
          <template #[`item.user.firstName`]="{item}">
            {{ item.user.nickName }}
          </template>
          <template #[`item.child.firstName`]="{item}">
            {{ item.child.length }}
          </template>
          <template #[`item.likes`]="{item}">
            {{ item.likes.length }}
          </template>
          <template #[`item.status`]="{item}">
            <span class="text-capitalize">
              {{ $t(item.status) }}
            </span>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
  export default {
    props: {
      data: {
        type: Array,
        default: null,
      },
    },
    data: () => ({
      headers: [
        {
          text: '#',
          value: 'id',
        },
        {
          text: 'table.discusses.th.name_class',
          align: 'start',
          sortable: false,
          value: 'class.name',
        },
        {
          text: 'table.discusses.th.body',
          align: 'start',
          sortable: false,
          value: 'body',
        },
        {
          text: 'table.discusses.th.author',
          align: 'start',
          sortable: false,
          value: 'user.firstName',
        },
        {
          text: 'table.discusses.th.comments',
          align: 'start',
          sortable: false,
          value: 'child.firstName',
        },
        {
          text: 'table.discusses.th.like',
          align: 'start',
          sortable: false,
          value: 'likes',
        },
        {
          text: 'Status',
          align: 'start',
          sortable: false,
          value: 'status',
        },
      ],
    }),
    methods: {
      reply (item) {
        this.$emit('reply', { item: item })
      },
      refreshMethods () {
        this.$emit('refresh')
      },
      deleteDiscuss (item) {
        this.$emit('delete', { item: item })
      },
    },
  }
</script>
<style lang="sass">
.size__icon_refresh
  font-size: 20px
</style>
