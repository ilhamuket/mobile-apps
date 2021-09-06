<template>
  <div />
</template>

<script>
  import { line } from 'vue-chartjs'
  export default {
    extends: line,
    props: {
      label: {
        type: String,
        default: null,
      },
      chartData: {
        type: Array,
        default: null,
      },
      options: {
        type: Object,
        default: null,
      },
    },
    mounted () {
      const dates = this.chartData.map(d => d.date).reverse()
      const totals = this.chartData.map(d => d.totals).reverse()

      this.renderChart(
        {
          labels: dates,
          dataSets: {
            label: this.label,
            data: totals,
          },
        },
        this.options,
      )
    },
  }
</script>

<style></style>
