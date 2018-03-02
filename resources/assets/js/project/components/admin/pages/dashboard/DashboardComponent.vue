<template>
  <div class="container">
      <h1>Home Page Dashboard</h1>
      <hr>
      <div class="row">
        <div class="col">
          <chart></chart>
        </div>
        <div class="col">
          <chart-two></chart-two>
        </div>
      </div>

      <hr>
      
      <div class="row">
        <div class="col">
          <chart-three></chart-three>
        </div>
      </div>

      <hr>

      <div class="row">
        <div class="col">
          <chart-four></chart-four>
        </div>
      </div>

  </div>
</template>

<script>
import TestCharts from '../charts/TestCharts'
import TestChartsTwo from '../charts/TestChartsTwo'
import TestChartsThree from '../charts/TestChartsThree'
import TestChartsFour from '../charts/TestChartsFour'

export default {
    components: {
        'chart': TestCharts,
        'chart-two': TestChartsTwo,
        'chart-three': TestChartsThree,
        'chart-four': TestChartsFour,
    }
}
</script>
