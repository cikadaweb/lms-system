<template>
  
    <div class="chart">
      <canvas ref="canvas"></canvas>
    </div>

</template>

<script>
import { Bar } from 'vue-chartjs'

export default {
  extends: Bar,
  props: ['chartData', 'options'],
  mounted () {
    this.renderChart(this.chartData, this.options)
  }
}
</script>

<style>
</style>