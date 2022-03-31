<template>
  
    <div class="chart">
      <canvas ref="canvas"></canvas>
    </div>

</template>

<script>
import { Pie } from 'vue-chartjs'

export default {
  extends: Pie,
  props: ['chartData', 'options'],
  mounted () {
    this.renderChart(this.chartData, this.options)
  }
}
</script>

<style>
</style>