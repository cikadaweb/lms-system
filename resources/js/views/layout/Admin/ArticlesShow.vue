<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="nav">
        <h2>Новости:</h2>
        <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
      </div>


      <div class="row mt-5">

        <div class="col-6 pb-3" v-for="article in getArticles" :key="article.id">
          <div class="card card_article">
            <img :src="`${article.img}`" class="card-img-top card_article-picture" alt="">
            <div class="card-body">
              <h5 class="card-title">{{ article.title }}</h5>
              <p class="card-text card_article-text" v-html="article.body"></p>
              <p>Дата публикации: {{ article.created_at }}</p>
              <a href="#" class="btn btn-primary">Подробнее</a>
              <div class="mt-3">
                <span class="badge bg-primary me-2">{{ article.statistic }} <i class="bi bi-hand-thumbs-up"></i></span>
                <span class="badge bg-danger me-2">{{ article.statistic }} <i class="bi bi-eye"></i></span>
              </div>
              <div class="mt-4">
                Теги:
                <a href="#" class="badge bg-danger me-2" v-for="tag in article.tags" :key="tag.id">{{ tag.label }}</a>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div> 
  <!-- <div class="container">
    <div class="row pt-3">
      
      <h2>Новости:</h2>

      <div class="row mt-5">

        <div class="col-6 pb-3" v-for="article in getArticles" :key="article.id">
          <div class="card card_article">
            <img :src="`${article.img}`" class="card-img-top card_article-picture" alt="">
            <div class="card-body">
              <h5 class="card-title">{{ article.title }}</h5>
              <p class="card-text card_article-text">{{ article.body }}</p>
              <p>{{ article.created_at }}</p>
              <a href="#" class="btn btn-primary">Подробнее</a>
              <div class="mt-3">
                <span class="badge bg-primary me-2">{{ article.statistic }} <i class="bi bi-hand-thumbs-up"></i></span>
                <span class="badge bg-danger me-2">{{ article.statistic }} <i class="bi bi-eye"></i></span>
              </div>
              <div class="mt-4">
                Теги:
                <a href="#" class="badge bg-danger me-2" v-for="tag in article.tags" :key="tag.id">{{ tag.label }}</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-6 pb-3">
          <div class="card card_article">
            <img src="../../../../img/news_2.png" class="card-img-top card_article-picture" alt="">
            <div class="card-body">
              <h5 class="card-title">АССОЦИАЦИИ «СТЕКЛОСОЮЗ» РОССИИ ПРОДОЛЖАЕТ РАБОТУ С МЕЖДУНАРОДНОЙ ОРГАНИЗАЦИЕЙ ПО СТАНДАРТИЗАЦИИ ISO ТК63 «СТЕКЛЯННАЯ ТАРА»</h5>
              <p class="card-text card_article-text">В адрес Ассоциации «СтеклоСоюз» России на имя Сергеевой Л.С. поступило письмо от Международной организации по стандартизации ISO ТК63 «Стеклянная тара», в котором говорится, что ISO по-прежнему стремится поддерживать открытую и нейтральную платформу для технических экспертов в целях разработки международных стандартов, признанных во всем мире в качестве незаменимой движущей силы для экономического и социального роста.</p>
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
  </div> -->

</template>

<script>

export default {
  name: "ArticlesShow",
  created() {
    this.$store.dispatch("articles/getArticles")
  },
  computed: {
    getArticles: {
      get() {
        return this.$store.state.articles.articlesList
      }
    },
  }
}
</script>



<style scoped lang="scss">

.custom-container-crud {
    background-color: rgb(255, 255, 255);
    border-radius: 15px;
    padding: 30px;
}

.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.card_article-picture {
  padding: 10px;
  max-height: 300px;
  object-fit: contain;
}

.card_article-text {
    height: 100px;
    text-indent: 5%;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>