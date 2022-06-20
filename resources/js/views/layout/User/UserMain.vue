<template>

  <div class="container">
    <div class="row pt-3">
      <div class="col-xl-12">

        <div class="dashboard-panel__title row pt-3">
          <div class=" col-xl-12">
            <h1>Результаты тестов:</h1>
          </div>
        </div>

        <div class="dashboard-panel-table row">
          <div class="col-xl-12 table-responsive">
            <table class="table table-light table-striped">
              <thead>
                <tr>
                  <th class="tabel-label">Номер теста</th>
                  <th class="tabel-label">Количество баллов</th>
                  <th class="tabel-label">Процент выполнения</th>
                  <th class="tabel-label">Дата прохождения</th>
                </tr>
              </thead>
              <tbody >
                <tr v-for="score in getUserScores" :key="score.id">
                  <td>{{ score.test_id }}</td>
                  <td>{{ score.score_count }} б</td>
                  <td>{{ score.score_percentage }} %</td>
                  <td>{{ score.created_at }}</td>
                </tr>
              </tbody>
            </table>

            <!-- <div class="table-pagination col-xl-12 d-flex justify-content-center">
              <Pagination v-if="search_input == ''"
                :pagination_url="pagination_url"
                v-on:set-paginate-items="setPaginateArticles"
              ></Pagination>
            </div> -->

          </div>
        </div>

        <div class="dashboard-panel__charts row pt-3">
          <div class="col-xl-6">
            <div class="chart">
              <BarChart :chartData="chartData1"></BarChart>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="chart">
              <BarChart :chartData="chartData2"></BarChart>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</template>



<script>
import BarChart from "../../ui/BarChart.vue";

export default {
  name: "UserMain",
  components: {BarChart},
  data() {
    return {
      chartData1: {
        labels: [
          '2022-06-13',
          '2022-06-13',
          '2022-06-16',
        ],
        datasets: [{
            label: 'Курс по резке стекла',
            data: [3, 4, 5],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
      },
      chartData2: {
        labels: [
          '2022-06-16',
          '2022-06-16',
          '2022-06-16',
        ],
        datasets: [{
            label: 'Курс по резке стекла 2',
            data: [3, 0, 5],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
      }
    }
  },
  created() {
    this.$store.dispatch("users/getUserScores", this.authUser.id)
  },
  computed: {
    getUserScores: {
      get() {
        return this.$store.state.users.currentUserScores
      }
    },
    authUser() {
      return this.$store.state.auth.authUser
    },
  }

}
</script>



<style scoped lang="scss">

.card:hover {
  transform: scale(1.1);
  transition-duration: .5s;
}

.chart{
  background-color: rgb(255, 255, 255);
  padding: 10px 10px;
  border-radius: 15px;
}

.card-icons {
  width: 50px;
  height: 50px;
}

.state-link {
  color: white;
}

</style>