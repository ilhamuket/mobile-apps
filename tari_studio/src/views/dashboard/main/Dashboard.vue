<template>
  <v-container
    id="dashboard"
    tag="section"
  >
    <v-row>
      <!-- Card Detail -->
      <v-col
        class="d-none d-md-flex"
        cols="12"
      >
        <v-card class="rounded-xl">
          <v-img
            height="140"
            class="img-oppa"
            src="@/assets/5833439.jpg"
          >
            <div class="d-flex flex-row justify-center">
              <div class="d-flex flex-column">
                <span
                  class="text-h1 font-title-rampart-one custome-font"
                >EnsikloTari</span>
              </div>
            </div>
          </v-img>
        </v-card>
      </v-col>
      <v-col
        class="d-none d-md-flex"
        cols="12"
      >
        <v-card
          width="97%"
          class="rounded-xl card"
        >
          <v-container>
            <v-row>
              <v-col cols="6">
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
                  <v-col cols="9">
                    <div class="d-flex flex-row mr-2 mt-2">
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
      <v-col
        cols="12"
        md="4"
      >
        <base-material-chart-card
          :data="dataCompletedTasksChart.data"
          :options="dataCompletedTasksChart.options"
          hover-reveal
          color="info"
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
      </v-col>
      <v-col
        cols="12"
        md="8"
      >
        <v-row>
          <v-col
            cols="12"
            md="6"
          >
            <base-material-stats-card
              color="info"
              icon="mdi-twitter"
              title="All"
              value="+245"
              sub-icon="mdi-clock"
              sub-text="Just Updated"
            />
          </v-col>
          <v-col
            cols="12"
            md="6"
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
            md="6"
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
            md="6"
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
        </v-row>
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
      }
    },
    computed: {},
    mounted () {},
    methods: {
      complete (index) {
        this.list[index] = !this.list[index]
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
.v-card
  border-radius: 6px
  margin-top: 30px
  margin-bottom: -18px
  border-radius: 30px !important
.card
  margin-top: -75px !important
  margin-left: 20px
.custome-font
  color: #384064 !important
  font-weight: bold
  font-size: 59px !important
.natural--card
  margin-right: -65px !important
.weight-200
  font-weight: 200 !important
</style>
<style scoped>
@media (max-width: 576px) {
  .text--responsive {
    margin-left: 20px;
  }
}
</style>
