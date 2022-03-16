<template>
  <v-app>
    <v-container
      id="dashboard"
      tag="section"
    >
      <v-row>
        <v-col
          cols="12"
          sm="6"
          lg="3"
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
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="primary"
            icon="mdi-poll"
            title="Website Visits"
            value="75.521"
            sub-icon="mdi-tag"
            sub-text="Tracked from Google Analytics"
          />
        </v-col>

        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="success"
            icon="mdi-store"
            title="Revenue"
            value="$ 34,245"
            sub-icon="mdi-calendar"
            sub-text="Last 24 Hours"
          />
        </v-col>

        <v-col
          cols="12"
          sm="6"
          lg="3"
        >
          <base-material-stats-card
            color="orange"
            icon="mdi-sofa"
            title="Bookings"
            value="184"
            sub-icon="mdi-alert"
            sub-icon-color="red"
            sub-text="Get More Space..."
          />
        </v-col>

        <v-col
          cols="12"
          md="6"
        >
          <base-material-card
            color="warning"
            class="px-5 py-3"
          >
            <template v-slot:heading>
              <div class="font-weight-light">
                Ensiklo Best Seller
              </div>

              <div class="font-weight-light">
                EnsikloTari on 15th September, 2016
              </div>
            </template>
            <v-card-text>
              <v-data-table
                :headers="headers"
                :items="items"
              />
            </v-card-text>
          </base-material-card>
        </v-col>
        <v-col
          cols="12"
          md="6"
        >
          <base-material-card
            color="warning"
            class="px-5 py-3"
          >
            <template v-slot:heading>
              <div class="font-weight-light">
                Studio Best Seller
              </div>

              <div class="font-weight-light">
                EnsikloTari on 15th September, 2016
              </div>
            </template>
            <v-card-text>
              <v-data-table
                :headers="headers"
                :items="items"
              />
            </v-card-text>
          </base-material-card>
        </v-col>
      </v-row>
    </v-container>
  </v-app>
</template>

<script>
  export default {
    name: 'DashboardDashboard',

    data () {
      return {
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
              text: 'Sign contract for "What are conference organizers afraid of?"',
              value: true,
            },
            {
              text: 'Lines From Great Russian Literature? Or E-mails From My Boss?',
              value: false,
            },
            {
              text: 'Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit',
              value: false,
            },
            {
              text: 'Create 4 Invisible User Experiences you Never Knew About',
              value: true,
            },
          ],
          1: [
            {
              text: 'Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit',
              value: true,
            },
            {
              text: 'Sign contract for "What are conference organizers afraid of?"',
              value: false,
            },
          ],
          2: [
            {
              text: 'Lines From Great Russian Literature? Or E-mails From My Boss?',
              value: false,
            },
            {
              text: 'Flooded: One year later, assessing what was lost and what was found when a ravaging rain swept through metro Detroit',
              value: true,
            },
            {
              text: 'Sign contract for "What are conference organizers afraid of?"',
              value: true,
            },
          ],
        },
        list: {
          0: false,
          1: false,
          2: false,
        },
      }
    },

    methods: {
      complete (index) {
        this.list[index] = !this.list[index]
      },
    },
  }
</script>
<style lang="sass">
.custome--cart
  p
    color: #999

  .ct-label
    color: inherit
    opacity: 1
    // font-size: 0.975rem
    font-weight: 100

  .ct-grid
    stroke: rgba(255, 255, 255, 0.2) !important

  .ct-series-a .ct-point,
  .ct-series-a .ct-line,
  .ct-series-a .ct-bar,
  .ct-series-a .ct-slice-donut
      stroke: rgba(255,255,255,.8) !important

  .ct-series-a .ct-slice-pie,
  .ct-series-a .ct-area
      fill: rgba(255,255,255,.4) !important
</style>
