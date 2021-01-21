<script>
//https://codesandbox.io/s/j47zp73845?file=/src/App.vue:1055-1087
import { Doughnut } from 'vue-chartjs'

export default {
  extends: Doughnut,
  props:['chartData','options'],
//   methods: {
//     update() {
//       this.$data._chart.update()
//     }
//   },
  mounted () {
    this.renderChart(this.chartData, this.options)
  }
};
</script>
