<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">

        <div class="nav">
          <div>
            <h2>{{ article.title }}</h2>
          </div>
          <div>
            <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
          </div>
        </div>

          <figure class="card-article">

            <img :src="article.img" class="article_picture" alt="">

            <figcaption class="figure-caption">
                <p>
                  <span class="article_tags">
                    <strong>Теги: </strong>
                      <span>label</span>
                      <span > | </span>
                      <span>extra</span>
                      <span>label</span>
                      <span > | </span>
                      <span>extra</span>
                  </span>
              </p>
            </figcaption>

            <figcaption class="figure-caption text-end">
              <span class="badge rounded-pill bg-success article_badge me-2">{{ likes }} <i class="bi bi-hand-thumbs-up"></i></span>
              <span class="badge rounded-pill bg-primary article_badge me-2">{{ views }} <i class="bi bi-eye"></i></span>
            
              <!-- <span class="badge rounded-pill bg-success article_badge me-2" v-if="article.statistic !== null">{{ article.statistic["likes"] }} <i class="bi bi-hand-thumbs-up"></i></span>
              <span class="badge rounded-pill bg-success article_badge me-2" v-else>0 <i class="bi bi-hand-thumbs-up"></i></span>
              
              <span class="badge rounded-pill bg-primary article_badge me-2" v-if="article.statistic !== null">{{ article.statistic["views"] }} <i class="bi bi-eye"></i></span>
              <span class="badge rounded-pill bg-primary article_badge me-2" v-else>0 <i class="bi bi-eye"></i></span> -->
            </figcaption>

            <p class="article_text pt-5" v-html="article.body"></p>
            <p>Опубликованно:  <i>{{ article.created_at }}</i></p>

          </figure>


        
      </div>

    </div>
  </div>



</template>

<script>

export default {

  name: "ArticleShowOne",
  computed: {
    article: {
      get() {
        return this.$store.state.articles.currentArticle
      }
    },
    // ToDo логика правильная, но нужно завершить
    views: {
      get() {
        return this.$store.getters['articles/articleViews']
      }
    },
    likes: {
      get() {
        return this.$store.getters['articles/articleLikes']
      }
    },
  },
  mounted() {
     this.$store.dispatch("articles/getArticleData", this.$route.params.id)
  },

}
</script>



<style lang="scss">

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

.article_picture {
  display: flex;
  margin: 0 auto;
  max-height: 500px;
  object-fit: contain;
}

.article_tags {
  font-size: 16px;
}

.article_badge {
  font-size: 16px;
}

</style>