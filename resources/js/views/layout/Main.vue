<template>

  <div class="container">

    <div class="row pt-5">

      <h2>Статистика по курсам:</h2>

      <div>
        <button class="btn btn-warning" @click="test">Тест гипотезы</button>
      </div>

      <div class="col-xl-6">
        <p>Активные курсы:</p>
        <ul>
          <li>Контролер стекольного производства</li>
          <li>Выдувальщик стеклоизделий</li>
          <li>Серебрильщик</li>
          <li>Закальщик стекла</li>
        </ul>
      </div>

      <div class="col-xl-6">
        <div class="chart">
          <PieChart :chartData="chartData"></PieChart>
        </div>
      </div>

      <!-- <div class="col-xl-4">
         <h1 class="text-center">О компании</h1>
          <p class="">Компания «Формула стекла» занимается производством стекла и стеклянных изделий любых видов. Наряду с типовой продукцией мы предоставляем нашим клиентам возможность самовыражения. Наличие мощной производственной базы позволяет нам учитывать ваши пожелания даже по сложным техническим проектам. Любые особенности декоративного оформления и дизайна изделий из стекол для нас – не проблема.</p>
      </div>
      <div class="col-xl-8">
        <figure>
          <img src="../../../img/fsk_main.jpg" class="img-thumbnail" alt="...">
          <figcaption class="text-center">Главный офис</figcaption>
        </figure>
      </div> -->
    </div>
  </div>

</template>



<script>
import PieChart from "../ui/PieChart";
import axios from "../../../axios/axios-instance";

export default {

  name: "Main",
  components: {PieChart},
  data() {
    return {
      chartData: {
        labels: ['Контролер стекольного производства', 'Выдувальщик стеклоизделий', 'Серебрильщик', 'Закальщик стекла'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
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
  methods: {
    async test() {
      try {
        const { data } = await axios.get("http://127.0.0.1:8000/api/articles");
        console.log(data)
      } catch (e) {
          console.log(e.message);
      }
    }
  }

}
</script>



<style scoped lang="scss">

.chart{
  background-color: rgb(255, 255, 255);
  padding: 10px 10px;
  border-radius: 15px;
}

</style>