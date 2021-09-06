import { Bar } from 'vue-chartjs'
export default {
  extends: Bar,
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
    const totals = this.chartData.map(d => d.total).reverse()

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
