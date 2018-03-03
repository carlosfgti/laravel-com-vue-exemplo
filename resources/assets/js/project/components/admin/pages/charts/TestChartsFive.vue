<script>
import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  data () {
    return {
      datacollection: {
        labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Julho'],
        datasets: [
          {
            label: 'Data One',
            borderColor: '#f87979',
            backgroundColor: 'transparent',
            data: [40, 60, 10, 80, 90]
          },
          {
            label: 'Data Two',
            borderColor: '#000',
            backgroundColor: 'transparent',
            data: [10, 40, 60, 80, 85]
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

