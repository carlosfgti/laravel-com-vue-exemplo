<script>
import { Scatter } from 'vue-chartjs'

export default {
  extends: Scatter,
  data () {
    return {
      
    }
  },
  mounted () {
    this.renderChart({
      datasets: [{
        label: 'GoLang',
        fill: false,
        borderColor: '#f87979',
        backgroundColor: '#f87979',
        data: [{
          x: 20,
          y: 50
        }, {
          x: 20,
          y: 20
        }, {
          x: 20,
          y: 31
        }, {
          x: 21,
          y: 20
        }, {
          x: 30,
          y: 50
        }]
      },
      {
        label: 'Kotlin',
        fill: false,
        borderColor: '#000',
        backgroundColor: '#000',
        data: [{
          x: 20,
          y: 40
        }, {
          x: 10,
          y: 10
        }, {
          x: 10,
          y: 21
        }, {
          x: 11,
          y: 10
        }, {
          x: 20,
          y: 40
        }]
      }]
    }, {responsive: true, maintainAspectRatio: false})
  }
}
</script>

