<script>
import { Scatter } from 'vue-chartjs'

export default {
  extends: Scatter,
  mounted () {
    this.renderChart({
      datasets: [{
        label: 'GoLang',
        fill: false,
        borderColor: '#f87979',
        backgroundColor: '#f87979',
        data: [{
          x: 0,
          y: 0,
        }, {
          x: 10,
          y: 10,
        }, {
          x: 20,
          y: 20,
        }, {
          x: 30,
          y: 30,
        }, {
          x: 40,
          y: 40,
        }, {
          x: 50,
          y: 50,
        }]
      },
      {
        label: 'Kotlin',
        fill: true,
        borderColor: '#000',
        backgroundColor: '#000',
        data: [{
          x: 1,
          y: 1,
        }, {
          x: 10,
          y: 20,
        }, {
          x: 15,
          y: 30,
        }, {
          x: 25,
          y: 30,
        }, {
          x: 35,
          y: 50,
        }, {
          x: 45,
          y: 20,
        }, {
          x: 50,
          y: 10,
        }]
      }]
    }, {responsive: true, maintainAspectRatio: false})
  }
}
</script>

