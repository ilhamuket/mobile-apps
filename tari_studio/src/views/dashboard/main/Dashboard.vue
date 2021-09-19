<template>
  <v-container
    id="dashboard"
    tag="section"
  >
    <v-row v-if="is_load">
      <loader
        object="#ff9633"
        color1="#ffffff"
        color2="#24e544"
        size="5"
        speed="2"
        bg="#343a40"
        objectbg="#e79b04"
        opacity="52"
        disable-scrolling="false"
        name="dots"
      />
      <v-row>
        <v-col
          cols="12"
          md="12"
        >
          <v-skeleton-loader
            class="bg-"
            v-bind="attrsLoad"
            type="date-picker"
          />
        </v-col>

        <v-col cols="12">
          <v-skeleton-loader
            v-bind="attrsLoad"
            type="list-item-avatar, divider, list-item-three-line, card-heading, image, actions"
          />

          <v-skeleton-loader
            v-bind="attrsLoad"
            type="list-item-avatar-three-line, image, article"
          />
        </v-col>
      </v-row>
    </v-row>
    <v-row v-else>
      <!-- Card Detail -->

      <v-col
        class="d-none d-md-flex"
        cols="12"
      >
        <v-card
          width="97%"
          class="rounded-xl mx-auto"
        >
          <v-container>
            <v-row>
              <v-col cols="6">
                <v-row v-if="users.studio">
                  <v-col
                    cols="3"
                    class="spsied"
                  >
                    <v-list-item-avatar
                      size="50"
                      color="primary"
                      class="ml-2"
                    >
                      <span>{{ users.studio.name.charAt(0) }}</span>
                    </v-list-item-avatar>
                  </v-col>
                  <v-col cols="9">
                    <div class="d-flex flex-row mr-2 mt-3">
                      <div class="d-flex flex-column">
                        <span class="text-h4 font-size-ather-roboto-mono">
                          Hai, {{ users.studio.name }}
                        </span>
                      </div>
                    </div>
                    <div class="d-flex flex-row">
                      <div class="d-flex flex-column">
                        <span
                          class="text-h4 font-size-ather-roboto-mono s-16 weight-200"
                        >
                          {{ users.studio.email }} -
                        </span>
                      </div>

                      <div class="d-flex flex-column ml-2">
                        <span
                          class="text-h4 font-size-ather-roboto-mono s-16 weight-200"
                        >
                          {{ users.studio.contact }}
                        </span>
                      </div>
                    </div>
                  </v-col>
                </v-row>
              </v-col>
              <v-col cols="6">
                <v-row>
                  <v-col>
                    <div class="d-flex flex-row mt-5 ml-6">
                      <div class="d-flex flex-column">
                        <v-btn
                          outlined
                          color="primary"
                          width="200"
                          small
                        >
                          Info
                        </v-btn>
                      </div>
                      <div class="d-flex flex-column ml-2">
                        <v-btn
                          outlined
                          color="primary"
                          width="200"
                          small
                        >
                          Info
                        </v-btn>
                      </div>
                    </div>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
      <!-- End Card Detail -->
      <!-- Card Detail Mobile -->
      <v-col
        v-if="$vuetify.breakpoint.mdAndDown"
        cols="12"
      >
        <v-card>
          <v-container>
            <v-row>
              <v-col>
                <v-row>
                  <v-col
                    class="natural--card"
                    cols="3"
                  >
                    <v-img
                      class="rounded-xl"
                      width="60"
                      src="https://demos.creative-tim.com/muse-vue-ant-design-dashboard/images/face-1.jpg"
                    />
                  </v-col>
                  <v-col
                    cols="9"
                    class="text--responsive"
                  >
                    <div class="d-flex flex-row ">
                      <div class="d-flex flex-column">
                        <span
                          class="text-h4 font-size-ather-roboto-mono font-weight-bold"
                        >
                          Hai, Studio Hurip
                        </span>
                      </div>
                    </div>
                    <div class="d-flex flex-row">
                      <div class="d-flex flex-column">
                        <span
                          class="text-h4 font-size-ather-roboto-mono s-16 weight-200"
                        >
                          HuripStudio@tari.id -
                        </span>
                      </div>

                      <div class="d-flex flex-column ml-2">
                        <span
                          class="text-h4 font-size-ather-roboto-mono s-16 weight-200"
                        >
                          0897524236451
                        </span>
                      </div>
                    </div>
                    <div class="d-flex flex-row">
                      <div class="d-flex flex-column">
                        <v-btn
                          small
                          width="100"
                          outlined
                          color="primary"
                        >
                          Info
                        </v-btn>
                      </div>
                      <div class="d-flex flex-column">
                        <v-btn
                          small
                          width="100"
                          class="ml-2"
                          outlined
                          color="primary"
                        >
                          Info
                        </v-btn>
                      </div>
                    </div>
                  </v-col>
                </v-row>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>
      <!-- EndCard Detail Mobile -->
      <!-- <v-col
        cols="12"
        md=""
      >
        <base-material-chart-card
          icon="mdi-account"
          hover-reveal
          color="#843839"
          type="Line"
        >
          <template v-slot:reveal-actions>
            <v-tooltip bottom>
              <template v-slot:activator="{ attrs, on }">
                <v-btn
                  v-bind="attrs"
                  color="info"
                  icon
                  v-on="on"
                >
                  <v-icon color="info">
                    mdi-refresh
                  </v-icon>
                </v-btn>
              </template>

              <span>Refresh</span>
            </v-tooltip>

            <v-tooltip bottom>
              <template v-slot:activator="{ attrs, on }">
                <v-btn
                  v-bind="attrs"
                  light
                  icon
                  v-on="on"
                >
                  <v-icon>mdi-pencil</v-icon>
                </v-btn>
              </template>

              <span>Change Date</span>
            </v-tooltip>
          </template>

          <h3
            class="card-title font-weight-light font-size-ather-roboto-mono-name-page mt-2 ml-2"
          >
            Student
          </h3>

          <p
            class="d-inline-flex font-weight-light ml-2 mt-1 font-size-ather-roboto-mono"
          >
            Last Last Campaign Performance
          </p>

          <template v-slot:actions>
            <v-icon
              class="mr-1"
              small
            >
              mdi-clock-outline
            </v-icon>
            <span
              class=" grey--text font-weight-light"
            >campaign sent 26 minutes ago</span>
          </template>
        </base-material-chart-card>
      </v-col> -->
      <v-col
        cols="12"
        md="12"
      >
        <v-row>
          <v-col
            cols="12"
            md="6"
          >
            <base-material-stats-card
              color="primary"
              icon="mdi-account-group-outline"
              :title="$t('classes')"
              :value="String(cumputedSummary.classes)"
              sub-icon="mdi-clock"
              sub-text="Just Updated"
              style="cursor:pointer"
              @click.native="toClass"
            />
          </v-col>
          <v-col
            cols="12"
            md="6"
          >
            <base-material-stats-card
              color="pallet1"
              icon="mdi-playlist-check"
              :title="$t('category')"
              :value="String(cumputedSummary.category)"
              sub-icon="mdi-clock"
              sub-text="Just Updated"
              style="cursor:pointer"
              @click.native="toNavigate('/sub-class')"
            />
          </v-col>

          <v-col
            cols="12"
            md="6"
          >
            <base-material-stats-card
              color="red"
              icon="mdi-alpha-v-box"
              :title="$t('vidio_name_page')"
              :value="String(cumputedSummary.vidio_profile)"
              sub-icon="mdi-clock"
              sub-text="Just Updated"
              style="cursor:pointer"
              @click.native="toNavigate('/vidio')"
            />
          </v-col>
          <v-col
            cols="12"
            md="6"
          >
            <base-material-stats-card
              color="secondary"
              icon="mdi-account-cowboy-hat-outline"
              :title="$t('instrucktur')"
              :value="String(cumputedSummary.instructor)"
              sub-icon="mdi-clock"
              sub-text="Just Updated"
              style="cursor:pointer"
              @click.native="toNavigate('/instructor')"
            />
          </v-col>
        </v-row>
      </v-col>
      <!-- <v-col
        cols="12"
        md="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="Followers"
          value="+245"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
        />
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="Followers"
          value="+245"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
        />
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="Followers"
          value="+245"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
        />
      </v-col>
      <v-col
        cols="12"
        md="3"
      >
        <base-material-stats-card
          color="info"
          icon="mdi-twitter"
          title="Followers"
          value="+245"
          sub-icon="mdi-clock"
          sub-text="Just Updated"
        />
      </v-col> -->
    </v-row>
  </v-container>
</template>

<script>
// import database from './database/daily.json'
// import moment from 'moment'
// import chart from './component/Chart'
  export default {
    name: 'DashboardDashboard',
    components: {
    // 'app-chart': chart,
    },
    data () {
      return {
        is_load: true,
        chartOptions: {
          responsive: true,
          maintainAspectRatio: false,
        },
        // database: database,
        value: [423, 446, 675, 510, 590, 610, 760],
        dailySalesChart: {
          data: {
            labels: ['M', 'T', 'W', 'T', 'F', 'S', 'S'],
            series: [[12, 17, 7, 17, 23, 18, 38]],
          },
          options: {
            lineSmooth: this.$chartist.Interpolation.cardinal({
              tension: 0,
            }),
            low: 0,
            high: 50, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
            chartPadding: {
              top: 0,
              right: 0,
              bottom: 0,
              left: 0,
            },
          },
        },
        dataCompletedTasksChart: {
          data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            series: [
              [1, 5, 2, 5, 4, 3],
              [2, 3, 4, 8, 1, 2],
              [5, 4, 3, 2, 1, 0.5],
            ],
          },
          options: {
            low: 0,
            showArea: true,
            showPoint: false,
            fullWidth: true,
          },
        },
        emailsSubscriptionChart: {
          data: {
            labels: [
              'Ja',
              'Fe',
              'Ma',
              'Ap',
              'Mai',
              'Ju',
              'Jul',
              'Au',
              'Se',
              'Oc',
              'No',
              'De',
            ],
            series: [
              [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
              [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
            ],
          },
          options: {
            axisX: {
              showGrid: false,
            },
            low: 0,
            high: 1000,
            chartPadding: {
              top: 0,
              right: 5,
              bottom: 0,
              left: 0,
            },
          },
          responsiveOptions: [
            [
              'screen and (max-width: 640px)',
              {
                seriesBarDistance: 5,
                axisX: {
                  labelInterpolationFnc: function (value) {
                    return value[0]
                  },
                },
              },
            ],
          ],
        },
        headers: [
          {
            sortable: false,
            text: 'ID',
            value: 'id',
          },
          {
            sortable: false,
            text: 'Name',
            value: 'name',
          },
          {
            sortable: false,
            text: 'Salary',
            value: 'salary',
            align: 'right',
          },
          {
            sortable: false,
            text: 'Country',
            value: 'country',
            align: 'right',
          },
          {
            sortable: false,
            text: 'City',
            value: 'city',
            align: 'right',
          },
        ],
        items: [
          {
            id: 1,
            name: 'Dakota Rice',
            country: 'Niger',
            city: 'Oud-Tunrhout',
            salary: '$35,738',
          },
          {
            id: 2,
            name: 'Minerva Hooper',
            country: 'Curaçao',
            city: 'Sinaai-Waas',
            salary: '$23,738',
          },
          {
            id: 3,
            name: 'Sage Rodriguez',
            country: 'Netherlands',
            city: 'Overland Park',
            salary: '$56,142',
          },
          {
            id: 4,
            name: 'Philip Chanley',
            country: 'Korea, South',
            city: 'Gloucester',
            salary: '$38,735',
          },
          {
            id: 5,
            name: 'Doris Greene',
            country: 'Malawi',
            city: 'Feldkirchen in Kārnten',
            salary: '$63,542',
          },
        ],
        tabs: 0,
        tasks: {
          0: [
            {
              text:
                'Sign contract for "What are conference organizers afraid of?"',
              value: true,
            },
            {
              text:
                'Lines From Great Russian Literature? Or E-mails From My Boss?',
              value: false,
            },
            {
              text:
                'Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit',
              value: false,
            },
            {
              text: 'Create 4 Invisible User Experiences you Never Knew About',
              value: true,
            },
          ],
          1: [
            {
              text:
                'Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit',
              value: true,
            },
            {
              text:
                'Sign contract for "What are conference organizers afraid of?"',
              value: false,
            },
          ],
          2: [
            {
              text:
                'Lines From Great Russian Literature? Or E-mails From My Boss?',
              value: false,
            },
            {
              text:
                'Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit',
              value: true,
            },
            {
              text:
                'Sign contract for "What are conference organizers afraid of?"',
              value: true,
            },
          ],
        },
        attrsLoad: {
          class: 'mb-6',
          boilerplate: true,
          elevation: 2,
        },
        list: {
          0: false,
          1: false,
          2: false,
        },
        arrPositive: [],
        arrHospitalize: [],
        arrInIcu: [],
        arrOnVentilators: [],
        arrRecorvered: [],
        arrDeaths: [],
        users: {},
      }
    },
    computed: {
      // users () {
      //   return this.$store.state.user.me
      // },
      cumputedSummary () {
        return this.$store.state.dashboardSummary.data
      },
    },
    mounted () {
      this.me()
      this.getDataSummary()
    },
    methods: {
      me () {
        this.$store
          .dispatch('user/me', {
            entities: 'studio',
          })
          .then(res => {
            this.users = res.data.data
            this.is_load = false
          })
      },
      complete (index) {
        this.list[index] = !this.list[index]
      },
      toClass () {
        this.$router.push('/class')
      },
      getDataSummary () {
        this.$store.dispatch('dashboardSummary/getDataSummary')
      },
      toNavigate (link) {
        this.$router.push(link)
      },
      chartON (data) {},
    // covid () {
    //   const data = this.database
    //   data.forEach(d => {
    //     const date = moment(d.date, 'YYYYMMDD').format('MM/DD')
    //     const {
    //       positive,
    //       hospiitalizedCurrently,
    //       inIcuCurrently,
    //       onVentilatorCurrently,
    //       recovered,
    //       death,
    //     } = d

    //     this.arrPositive.push({ date, total: positive })
    //     this.arrHospitalize.push({ date, total: hospiitalizedCurrently })
    //     this.arrInIcu.push({ date, total: inIcuCurrently })
    //     this.arrOnVentilators.push({ date, total: onVentilatorCurrently })
    //     this.arrRecorvered.push({ date, total: recovered })
    //     this.arrDeaths.push({ date, total: death })
    //   })
    // },
    },
  }
</script>
<style lang="sass" scoped>
.spsied
  -webkit-box-flex: 0
  -ms-flex: 0 0 25%
  lex: 0 0 25%
  max-width: 13%

.theme--dark.v-skeleton-loader .v-skeleton-loader__actions, .theme--dark.v-skeleton-loader .v-skeleton-loader__article, .theme--dark.v-skeleton-loader .v-skeleton-loader__card-heading, .theme--dark.v-skeleton-loader .v-skeleton-loader__card-text, .theme--dark.v-skeleton-loader .v-skeleton-loader__date-picker, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-avatar, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-text, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-two-line, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-avatar-two-line, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-three-line, .theme--dark.v-skeleton-loader .v-skeleton-loader__list-item-avatar-three-line, .theme--dark.v-skeleton-loader .v-skeleton-loader__table-heading, .theme--dark.v-skeleton-loader .v-skeleton-loader__table-thead, .theme--dark.v-skeleton-loader .v-skeleton-loader__table-tbody, .theme--dark.v-skeleton-loader .v-skeleton-loader__table-tfoot
    background: #283046 !important
    background-image: initial
    background-position-x: initial
    background-position-y: initial
    background-size: initial
    background-repeat-x: initial
    background-repeat-y: initial
    background-attachment: initial
    background-origin: initial
    background-clip: initial
    background-color: rgb(87, 38, 38)
.v-card
  border-radius: 6px
  margin-top: 30px
  margin-bottom: -18px
  border-radius: 30px !important
.card
  margin-top: -75px !important
  margin-left: 20px
.custome-font
  color: #843839 !important
  font-weight: bold
  font-size: 59px !important
.natural--card
  margin-right: -65px !important
.weight-200
  font-weight: 200 !important
.img--card
  background-image: red !important
// .theme--dark .v-skeleton-loader
//   background-color: red !important
// .theme--dark
//   .v-expansion-panels .v-expansion-panel
//     background-color: #283046 !important
//     color: #FFFFFF
.img-oppa
  background-color: #843839 !important
</style>

<style scoped>
@media (max-width: 576px) {
  .text--responsive {
    margin-left: 20px;
  }
}
</style>
