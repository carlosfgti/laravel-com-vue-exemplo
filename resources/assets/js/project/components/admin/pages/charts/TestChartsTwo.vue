<script>
import { Bar, Line } from 'vue-chartjs'

export default {
  extends: Bar,
  data () {
    return {
      
    }
  },
  mounted () {
    this.renderChart({
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label: 'GitHub Commits',
          backgroundColor: '#000',
          data: [10, 20, 30, 40, 50, 60, 70, 80, 90, 100, 110, 120]
        }
      ]
    })
  }
}
</script>

