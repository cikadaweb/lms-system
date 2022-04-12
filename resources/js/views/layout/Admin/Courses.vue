<template>

  <div class="container">
    <div class="row pt-3">
      
      <h2>Активные курсы:</h2>

      <div class="pt-2 pb-3">
        <my-button class="btn-success">Создать курс</my-button>
      </div>
    
      <div class="row mt-2">

        <div class="col-6 pb-3">
          <div class="card card_news">
            <img src="../../../../img/fsk_rezka.jpg" class="card-img-top card_news-picture" alt="">
            <div class="card-body">
              <h5 class="card-title">Курс по резке стекла</h5>
              <p class="card-text card_news-text">Целью международного конкурса «Лидер стекольной отрасли - 2022» является привлечение внимания потребителей к персонам и компаниям, работающим в стекольной индустрии. Достижение успеха в этой сложнейшей области предпринимательства неразрывно связано с развитием науки управления.</p>
              <p>130ч</p>
              <a href="#" class="btn btn-primary">Перейти</a>

              <!-- <div class="mt-3">
                <span class="badge bg-primary">30 <i class="bi bi-hand-thumbs-up"></i></span>
                <span class="badge bg-danger">100 <i class="bi bi-eye"></i></span>
              </div> -->

              <!-- <div class="mt-4">
                Теги:
                <a href="#" class="badge bg-danger">Тег1</a>
                <a href="#" class="badge bg-danger">Тег2</a>
              </div> -->

            </div>
          </div>
        </div>

      </div>
      
    </div>
  </div>

</template>

<script>

export default {
  name: "Courses",
}
</script>



<style scoped lang="scss">

</style>