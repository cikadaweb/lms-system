<template>

  <div class="container custom-container-crud">
    <div class="row pt-3 pb-3">
      <div class="col-xl-12">

        <div class="blog-panel-title row ps-3">
          <div class="col-xl-12 d-flex justify-content-between align-items-center">
            <h1>{{ article.title }}</h1>
            <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
          </div>
        </div>

        <div class="blog-panel-content row">
            <figure class="col-xl-12 card-article">
              <img :src="article.img" class="article_picture" alt="">
              <figcaption class="figure-caption">
                  <p>
                    <span class="article_tags">
                      <strong>Теги: </strong>
                        <span class="tag" v-for="(tag,index) in article.tags" :key="tag.id">
                            <span v-if="tagsLen == (index+1)">{{tag.label}}</span>
                            <span v-else>{{tag.label}} | </span>
                        </span>
                    </span>
                </p>
              </figcaption>

              <figcaption class="figure-caption text-end">
                <LikesState></LikesState>
                <ViewsState></ViewsState>
              </figcaption>

              <p class="article_text pt-5" v-html="article.body"></p>
              <p>Опубликованно:  <i>{{ article.created_at }}</i></p>
            </figure>
        </div>

        <div class="blog-panel-comments row">
          <Comments></Comments>
        </div>


      </div>
    </div>
  </div>



</template>

<script>
import ViewsState from "../../ui/ViewsState.vue"
import LikesState from "../../ui/LikesState.vue"
import Comments from "../../ui/Comments.vue"

export default {
  components: { LikesState, ViewsState, Comments },

  name: "ArticleShowOne",
  computed: {
    article: {
      get() {
        return this.$store.state.articles.currentArticle
      }
    },
    tagsLen: {
      get() {
        return this.$store.state.articles.currentArticle.tags.length
      } 
    },


  },
  mounted() {
     this.$store.dispatch("articles/getArticleData", this.$route.params.id)
     this.$store.dispatch('articles/viewsIncrement',  this.$route.params.id)
  },

}
</script>



<style lang="scss">

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