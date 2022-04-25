<template>

  <div class="container">

    <div class="row pt-5">

      <h2 class="pb-2">Статистика по курсам:</h2>


      <div class="col-xl-3">
        <div class="card text-white bg-info mb-3" style="max-width: 18rem;">
          <div class="d-flex justify-content-between align-items-center text-center">
            <div class="card-body">
              <h2 class="card-text">15</h2>
              <h5 class="card-title">Статьи</h5>
            </div>
            <div class="card-body">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-newspaper card-icons" viewBox="0 0 16 16">
                <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
              </svg>
            </div>
          </div>
          <div class="card-header text-center">Все статьи <i class="bi bi-arrow-right-circle"></i></div>
        </div>
      </div>

      <div class="col-xl-3">
        <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
          <div class="d-flex justify-content-between align-items-center text-center">
            <div class="card-body">
              <h2 class="card-text">2</h2>
              <h5 class="card-title">Курсы</h5>
            </div>
            <div class="card-body">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-book card-icons" viewBox="0 0 16 16">
                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
              </svg>
            </div>
          </div>
          <div class="card-header text-center">Все курсы <i class="bi bi-arrow-right-circle card-icons"></i></div>
        </div>
      </div>

      <div class="col-xl-3">
        <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
          <div class="d-flex justify-content-between align-items-center text-center">
            <div class="card-body">
              <h2 class="card-text">15</h2>
              <h5 class="card-title">Тесты</h5>
            </div>
            <div class="card-body">
             <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pencil card-icons" viewBox="0 0 16 16">
              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
            </svg>
            </div>
          </div>
          <div class="card-header text-center">Все тесты <i class="bi bi-arrow-right-circle card-icons"></i></div>
        </div>
      </div>

      <div class="col-xl-3">
        <div class="card text-white bg-warning mb-3" style="max-width: 18rem;"> 
          <div class="d-flex justify-content-between align-items-center text-center">
            <div class="card-body">
              <h2 class="card-text">15</h2>
              <h5 class="card-title">Пользователи</h5>
            </div>
            <div class="card-body">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-people card-icons" viewBox="0 0 16 16">
                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
              </svg>
            </div>
          </div>
          <div class="card-header text-center">Все пользователи <i class="bi bi-arrow-right-circle"></i></div>
        </div>
      </div>

      <div class="col-xl-6">
        <div class="chart">
          <PieChart :chartData="chartData"></PieChart>
        </div>
      </div>

      <!-- <router-link :to="'/'">
        <button class="btn btn-warning" @click="test">Тест гипотезы</button>
      </router-link> -->

      <!-- <div class="col-xl-6">
        <p>Активные курсы:</p>
        <ul>
          <li>Контролер стекольного производства</li>
          <li>Выдувальщик стеклоизделий</li>
          <li>Серебрильщик</li>
          <li>Закальщик стекла</li>
        </ul>
      </div> -->



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
      console.log("Пока ничего")
      // try {
      //   const { data } = await axios.get("http://127.0.0.1:8000/api/articles");
      //   console.log(data)
      // } catch (e) {
      //     console.log(e.message);
      // }
    }
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

</style>