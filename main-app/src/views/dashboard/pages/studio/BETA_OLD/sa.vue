<template>
  <v-row>
    <v-col>
      <v-list-item-content
        v-for="(comment, i) in comments"
        :key="i"
        class="shaped-comments"
      >
        <v-list-item-action-text v-if="comment.parent_id === null">
          <div
            class="d-flex flex-row flex-nowrap justify-start align-start border-comments"
          >
            <div class="d-flex flex-column align-center">
              <v-avatar
                class="ma-3"
                size="32"
              >
                <v-img
                  src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                />
              </v-avatar>
            </div>
            <div class="d-flex flex-column flex-nowrap align-start flex-grow-1">
              <div>
                <h4
                  v-if="comment.user"
                  class="font-weight-bold"
                >
                  {{ comment.user.firstName + ' ' + comment.user.lastName }}
                  -
                  <span>
                    {{ comment.created_at | moment('dddd D MMM YYYY') }}
                  </span>
                  -
                  {{
                    comment.user.id === vidio.author.id ? 'Creator' : 'Visitor'
                  }}
                </h4>
              </div>
              <v-card-text>
                {{ comment.comment }}
              </v-card-text>
              <div
                style="cursor:pointer"
                class="d-flex flex-column justify-end"
              >
                <h4
                  class="ml-2"
                  @click="replies(comment)"
                >
                  Balas
                </h4>
              </div>
              <div
                v-if="comment.isReplies"
                class="d-flex flex-no-wrap justify-start align-start"
              >
                <div class="d-flex flex-column align-center">
                  <v-avatar
                    class="ma-3"
                    size="32"
                  >
                    <v-img
                      src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                    />
                  </v-avatar>
                </div>

                <div class="d-flex flex-column align-start flex-grow-1">
                  <v-form
                    style="width: 100%"
                    class="padding-form-replies"
                    @submit.prevent.enter="repliesComments(comment)"
                  >
                    <v-text-field
                      v-model="data.repliesComment"
                      :label="`comment as Mahardika`"
                    />
                  </v-form>
                </div>

                <div class="d-flex align-center align-self-sm-center mr-3">
                  <v-tooltip
                    right
                    color="blue"
                  >
                    <template v-slot:activator="{ on, attrs }">
                      <v-icon
                        v-bind="attrs"
                        color="blue"
                        type="submit"
                        v-on="on"
                        @click="repliesComments(comment)"
                      >
                        mdi-send
                      </v-icon>
                    </template>
                    <span>send</span>
                  </v-tooltip>
                </div>
              </div>
            </div>
          </div>
        </v-list-item-action-text>

        <div
          v-if="comment.child !== null"
          class="mt-4"
        >
          <v-list-item-subtitle
            v-for="(child, index) in comment.child"
            :key="index"
            class="ml-12 shaped-subtitle"
          >
            <div class="d-flex flex-row flex-nowrap justify-start align-start">
              <div class="d-flex flex-column align-center">
                <v-avatar
                  class="ma-3"
                  size="32"
                >
                  <v-img
                    src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                  />
                </v-avatar>
              </div>
              <div class="d-flex flex-column align-start">
                <div
                  v-if="child.user"
                  class="font-weight-bold"
                >
                  <h5
                    style="font-weight: bold"
                    class=""
                  >
                    {{ child.user.firstName + ' ' + child.user.lastName }}
                    -
                    <span class="text-date">
                      {{ child.created_at | moment('dddd D MMM YYYY') }}
                      -
                      {{
                        child.user.id === vidio.author.id
                          ? 'Creator'
                          : 'Visitor'
                      }}
                    </span>
                  </h5>
                  <v-card-text class="mt-1 ml-1">
                    {{ child.comment }}
                  </v-card-text>
                  <div
                    style="cursor:pointer"
                    class="d-flex flex-column justify-end"
                  >
                    <h5
                      class="ml-2 mb-2"
                      @click="repliesParents(child)"
                    >
                      Balas
                    </h5>
                  </div>
                </div>
                <div
                  v-if="child.isReplies"
                  class="d-flex flex-no-wrap justify-start align-start"
                >
                  <div class="d-flex flex-column align-center">
                    <v-avatar
                      class="ma-3"
                      size="32"
                    >
                      <v-img
                        src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
                      />
                    </v-avatar>
                  </div>

                  <div class="d-flex flex-column align-start flex-grow-1">
                    <v-form
                      style="width: 100%"
                      class="padding-form-replies"
                      @submit.prevent.enter="repliesNestingComments(child)"
                    >
                      <v-text-field
                        v-model="data.repliesNestingComment"
                        placeholder="Type Something ..."
                        :prefix="
                          `@${comment.user.firstName +
                            ' ' +
                            comment.user.lastName}`
                        "
                      />
                    </v-form>
                  </div>

                  <div class="d-flex align-center align-self-sm-center mr-3">
                    <v-tooltip
                      right
                      color="blue"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-icon
                          v-bind="attrs"
                          color="blue"
                          type="submit"
                          v-on="on"
                          @click="repliesNestingComments(child)"
                        >
                          mdi-send
                        </v-icon>
                      </template>
                      <span>send</span>
                    </v-tooltip>
                  </div>
                </div>
              </div>
            </div>
          </v-list-item-subtitle>
        </div>
      </v-list-item-content>
      <v-list-item-content>
        <div class="d-flex flex-nowrap justify-start">
          <div class="d-flex flex-column align-center">
            <v-avatar
              class="ma-3"
              size="32"
            >
              <v-img
                src="https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription02&hairColor=Black&facialHairType=Blank&clotheType=Hoodie&clotheColor=White&eyeType=Default&eyebrowType=DefaultNatural&mouthType=Default&skinColor=Light"
              />
            </v-avatar>
          </div>
          <div class="d-flex flex-nowrap flex-column align-start flex-grow-1">
            <v-form
              class="padding-form"
              style="width: 100%"
              @submit.prevent.enter="sendComments"
            >
              <v-text-field
                v-model="data.comment"
                :label="`Comment as mahardika`"
                solo
                outlined
                append-icon="mdi-send"
                @click:append="sendComments"
              />
            </v-form>
          </div>
        </div>
      </v-list-item-content>
    </v-col>
  </v-row>
</template>

<script>
  export default {
    props: {
      comments: {
        type: Array,
        default: null,
      },
      vidio: {
        type: Object,
        default: null,
      },
    // childComments: {
    //   type: Array,
    //   default: null,
    // },
    },
    data: () => ({
      data: {
        comment: '',
        repliesComment: '',
        repliesNestingComment: '',
      },
    }),
    methods: {
      replies (item) {
        item.isReplies = !item.isReplies
      },
      sendComments () {
        this.$emit('comments', { item: this.data })
      },
      repliesParents (item) {
        item.isReplies = !item.isReplies
      },
      repliesComments (item) {
        this.$emit('Replies', {
          item: {
            item: this.data,
            parent_id: item.id,
          },
        })
      },
      repliesNestingComments (item) {
        this.$emit('nestingReplies', {
          item: {
            item: this.data,
            parent_id: item.id,
            user: item.user,
          },
        })
      },
    },
  }
</script>

<style lang="sass" scoped>
.theme--light .v-list
  background-color: #ffff !important
.v-list-item
  padding-left: -60px !important
.theme--dark .v-list .v-list-item
    background-color: #283046 !important
.theme--dark .v-list
  background-color: #283046 !important
  padding-right: 20px !important
.v-list-item
  padding: 0 -9px !important

.padding
  padding: 0 -100px !important
.padding-form
  padding: 0 1px !important
  width: 640px !important
.padding-form-replies
  padding: 0 1px !important
  width: 470px !important
.font-weight-bold
  font-weight: bold !important
.opacity
  opacity: 0
  &:hover
    opacity: 1
.border-comments
  border-radius: 25px !important
  padding-bottom: 5px !important
</style>
