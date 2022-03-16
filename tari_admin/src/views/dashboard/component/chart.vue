<template>
  <v-container>
    <v-row>
      <v-col
        cols="12"
        md="8"
        class="mt-8"
      >
        <!-- <v-card> -->
        <span class="font-spartan btn_primary--text"> Daily Sales </span>
        <chartist
          class="custome--cart mt-6"
          :data="dailySalesChart.data"
          :options="dailySalesChart.options"
          type="Line"
          style="max-height: 550px"
        />
        <!-- </v-card> -->
      </v-col>
      <v-col
        cols="12"
        md="4"
      >
        <v-card>
          <v-container>
            <v-row>
              <v-col cols="12">
                <div>
                  <span class="font-spartan btn_primary--text"> Filter </span>
                </div>
              </v-col>
              <v-col cols="12">
                <v-select label="Month " />
                <v-select
                  label="Week"
                  :items="week"
                  item-value="name"
                  item-text="name"
                />
              </v-col>
              <v-col
                cols="12"
                class="d-flex justify-end"
              >
                <v-btn color="btn_primary">
                  Filter
                </v-btn>
              </v-col>
            </v-row>
          </v-container>
        </v-card>
      </v-col>

      <v-col
        cols="12"
        md="8"
        class="mt-2"
      >
        <!-- <v-card> -->
        <span class="font-spartan btn_primary--text"> Monthly Sales </span>
        <br>
        <br>
        <span class="ml-2 mt-4 primary--text">Ribuan [k]</span>
        <chartist
          class="custome--cart mt-6"
          :data="dataCompletedTasksChart.data"
          :options="dataCompletedTasksChart.options"
          type="Line"
          style="max-height: 550px"
        />
        <div class="d-flex justify-end">
          <span class="ml-7 primary--text">Bulan</span>
        </div>
        <!-- </v-card> -->
      </v-col>
      <v-col cols="12" />
      <!-- <v-col
          cols="12"
          md="3"
        >
          <v-row>
            <v-col cols="12">
              <base-material-stats-card
                color="primary"
                icon="mdi-poll"
                title="Website Visits"
                value="75.521"
                sub-icon="mdi-tag"
                sub-text="Tracked from Google Analytics"
              />
            </v-col>
            <v-col cols="12">
              <base-material-stats-card
                color="primary"
                icon="mdi-poll"
                title="Website Visits"
                value="75.521"
                sub-icon="mdi-tag"
                sub-text="Tracked from Google Analytics"
              />
            </v-col>
            <v-col cols="12">
              <base-material-stats-card
                color="primary"
                icon="mdi-poll"
                title="Website Visits"
                value="75.521"
                sub-icon="mdi-tag"
                sub-text="Tracked from Google Analytics"
              />
            </v-col>
          </v-row>
        </v-col> -->
    </v-row>
  </v-container>
</template>

<script>
  export default {
    data: () => ({
      dailySalesChart: {
        data: {
          labels: [
            'Monday',
            'Tuesday',
            'Wednesday',
            'ThursDay',
            'Friday',
            'Saturday',
            'Sunday',
          ],
          series: [[1, 20, 17, 17, 123, 108, 188]],
        },
        options: {
          lineSmooth: this.$chartist.Interpolation.cardinal({
            tension: 0,
          }),
          low: 0,
          high: 188 + 5, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
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
            [
              15.42, 44.3, 32.22, 73.38, 52.253, 44.453, 4.326, 44.344, 54.468,
              444.61, 74.456, 84.495,
            ],
          ],
        },
        options: {
          lineSmooth: this.$chartist.Interpolation.cardinal({
            tension: 0,
          }),
          low: 0,
          high: 444 + 5, // creative tim: we recommend you to set the high sa the biggest value + something for a better look
          chartPadding: {
            top: 0,
            right: 10,
            bottom: 0,
            left: 0,
          },
        },
      },
      week: [
        {
          name: 'Week 1',
          value: '15.42',
        },
        {
          name: ' Week 2',
          value: '44.3',
        },
        {
          name: 'Week 3',
          value: '32.22',
        },
        {
          name: 'Week 4',
          value: '73.38',
        },
      ],
    }),
  }
</script>

<style></style>
