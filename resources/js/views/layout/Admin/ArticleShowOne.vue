<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="col-12 p-3">

        <div class="nav">
          <h2>{{ article.title }}</h2>
          <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
        </div>

        <img :src="article.img" class="card_article-picture" alt="">
        <p>
            <span class="tag">
                <span>label</span>
                <span > | </span>
                <span>extra</span>
                <span>label</span>
                <span > | </span>
                <span>extra</span>
            </span>
        </p>
        <p class="card_article-text" v-html="article.body"></p>
        <p>Опубликованно:  <i>{{ article.created_at }}</i></p>
        <div class="mt-3">
            <span class="badge bg-success me-2">45 <i class="bi bi-hand-thumbs-up"></i></span>
            <span class="badge bg-primary me-2">105 <i class="bi bi-eye"></i></span>
        </div>
        
      </div>

    </div>
  </div>



</template>

<script>

export default {

  name: "ArticleShowOne",
  computed: {
    article() {
      return this.$store.state.articles.currentArticle
    }
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

.card_article-picture {
  display: flex;
  padding: 10px;
  margin: 0 auto;
  max-height: 500px;
  object-fit: contain;
}

</style>