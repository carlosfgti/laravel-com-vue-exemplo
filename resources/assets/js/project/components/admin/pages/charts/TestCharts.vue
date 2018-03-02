<script>
import { Bar, Line } from 'vue-chartjs'

export default {
  extends: Bar,
  data () {
    return {
      datacollection: {
        labels: ['January', 'February'],
        datasets: [
          {
            label: 'Data One',
            backgroundColor: '#f87979',
            data: [40, 20]
          },
          {
            label: 'Data Two',
            backgroundColor: '#000',
            data: [80, 0]
          }
        ]
      }
    }
  },
  mounted () {
    this.renderChart(this.datacollection, {responsive: true, maintainAspectRatio: false})
  }
}
</script>

