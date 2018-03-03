<script>
import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  props: {
      labels: {
          type: Array,
          require: true,
      },
      datasets: {
          type: Array,
          require: true,
      }
  },
  mounted () {
    this.renderChart({
        labels: this.labels,
        datasets: this.datasets
    }, {
        responsive: true,
        maintainAspectRatio: false
    })
  }
}
</script>

