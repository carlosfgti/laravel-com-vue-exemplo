<template>
  <div class="container">
      <h1>Gráficos</h1>
      <hr>

      <div class="row">
        <div class="col">
          <chart-five></chart-five>
        </div>
      </div>

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
import TestCharts from './TestCharts'
import TestChartsTwo from './TestChartsTwo'
import TestChartsThree from './TestChartsThree'
import TestChartsFour from './TestChartsFour'
import TestChartsFive from './TestChartsFive'

export default {
    components: {
        'chart': TestCharts,
        'chart-two': TestChartsTwo,
        'chart-three': TestChartsThree,
        'chart-four': TestChartsFour,
        'chart-five': TestChartsFive,
    }
}
</script>
