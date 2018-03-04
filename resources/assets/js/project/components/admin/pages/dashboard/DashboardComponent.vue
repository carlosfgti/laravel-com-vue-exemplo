<template>
  <div class="container">
      <h1>Home Page Dashboard</h1>
      <hr>

      <div class="row">
        <div class="col">
          <chart-six
            :labels="labels"
            :datasets="datasets">
          </chart-six>
        </div>
      </div>

  </div>
</template>

<script>
import TestChartsSix from '../charts/TestChartsSix'

export default {
    data () {
      return {
        labels: ['ja', 'fe', 'ma', 'ab', 'ju'],
        datasets: [
          {
            label: 'Data One',
            borderColor: 'red',
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
    },
    components: {
        'chart-six': TestChartsSix,
    }
}
</script>
