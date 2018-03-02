<template>
  <div class="container">
      <h1>Relatórios</h1>

      <chart></chart>
  </div>
</template>


<script>
import TestCharts from './TestCharts'
import TestChartsTwo from './TestChartsTwo'

export default {
    components: {
        'chart': TestCharts,
        'chart-two': TestChartsTwo
    }
}
</script>
