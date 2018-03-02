<script>
import { Line } from 'vue-chartjs'

export default {
  extends: Line,
  data () {
    return {
    }
  },
  mounted () {
    this.renderChart({
      labels: ['January', 'February', 'March'],
      datasets: [
        {
          label: 'Vendas por mês',
          backgroundColor: '#000',
          data: [10, 20, 30]
        }
      ]
    })
  }
}
</script>

