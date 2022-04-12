<template>

  <div class="container">
    <div class="row pt-3">
      
      <h2>Новости:</h2>

      <div class="pt-2 pb-3">
        <router-link :to="'/news/create'">
          <my-button class="btn-success">Добавить объявление</my-button>
        </router-link>
      </div>

      <div class="row mt-5">

        <div class="col-6 pb-3">
          <div class="card card_news">
            <img src="../../../../img/news_1.jpeg" class="card-img-top card_news-picture" alt="">
            <div class="card-body">
              <h5 class="card-title">МЕЖДУНАРОДНЫЙ ОТРАСЛЕВОЙ КОНКУРС «ЛИДЕР СТЕКОЛЬНОЙ ОТРАСЛИ - 2022»</h5>
              <p class="card-text card_news-text">Целью международного конкурса «Лидер стекольной отрасли - 2022» является привлечение внимания потребителей к персонам и компаниям, работающим в стекольной индустрии. Достижение успеха в этой сложнейшей области предпринимательства неразрывно связано с развитием науки управления.</p>
              <p>19.04.22</p>
              <a href="#" class="btn btn-primary">Подробнее</a>
              <div class="mt-3">
                <span class="badge bg-primary">30 <i class="bi bi-hand-thumbs-up"></i></span>
                <span class="badge bg-danger">100 <i class="bi bi-eye"></i></span>
              </div>
              <div class="mt-4">
                Теги:
                <a href="#" class="badge bg-danger">Тег1</a>
                <a href="#" class="badge bg-danger">Тег2</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 pb-3">
          <div class="card card_news">
            <img src="../../../../img/news_2.png" class="card-img-top card_news-picture" alt="">
            <div class="card-body">
              <h5 class="card-title">АССОЦИАЦИИ «СТЕКЛОСОЮЗ» РОССИИ ПРОДОЛЖАЕТ РАБОТУ С МЕЖДУНАРОДНОЙ ОРГАНИЗАЦИЕЙ ПО СТАНДАРТИЗАЦИИ ISO ТК63 «СТЕКЛЯННАЯ ТАРА»</h5>
              <p class="card-text card_news-text">В адрес Ассоциации «СтеклоСоюз» России на имя Сергеевой Л.С. поступило письмо от Международной организации по стандартизации ISO ТК63 «Стеклянная тара», в котором говорится, что ISO по-прежнему стремится поддерживать открытую и нейтральную платформу для технических экспертов в целях разработки международных стандартов, признанных во всем мире в качестве незаменимой движущей силы для экономического и социального роста.</p>
              <p>22.04.22</p>
              <a href="#" class="btn btn-primary">Подробнее</a>
              <div class="mt-3">
                <span class="badge bg-primary">40 <i class="bi bi-hand-thumbs-up"></i></span>
                <span class="badge bg-danger">90 <i class="bi bi-eye"></i></span>
              </div>
              <div class="mt-4">
                Теги:
                <a href="#" class="badge bg-danger">Тег1</a>
                <a href="#" class="badge bg-danger">Тег2</a>
              </div>
            </div>
          </div>
        </div>

      </div>
      
      
    </div>
  </div>

</template>

<script>

export default {
  name: "News",
}
</script>



<style lang="scss">

.card_news-picture {
  padding: 10px;
  max-height: 300px;
  object-fit: contain;
}

.card_news-text {
    height: 100px;
    text-indent: 5%;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>