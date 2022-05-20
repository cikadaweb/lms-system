<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="blog-title col-xl-12 d-flex justify-content-between align-items-center ps-3">
        <h1>Новости</h1>
        <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
      </div>

      <div class="blog-filter col-xl-12 d-flex justify-content-between pt-3">

          <div class="blog-filter-left">
            <form class="d-flex">
              <input class="form-control panel-input" v-model="search_input" @input="getArticlesBySearch" type="search" placeholder="Найти статью" aria-label="Search">
              <button class="btn btn-primary" @click.prevent type="submit"><i class="bi bi-search"></i></button>
            </form>
          </div>

          <div class="blog-filter-right d-flex">

            <select 
              class="form-select table-nav__select" 
              aria-label="Default select example"
              v-model="filter_tag" 
              @change="filterArticlesByStatus"
            >
              <option value="" selected disabled>Теги </option>
              <option 
              v-for="tag in getTags"
              :key="tag.id" 
              :value="tag.label"
              >{{ tag.label }}</option>
            </select>

          </div>
      </div>

      <div class="blog-cards col-xl-12">
        <div class="row mt-5">

          <div class="col-xl-6 pb-3" v-for="article in getArticles" :key="article.id">
            <div class="card card_article">
              <img :src="`${article.img}`" class="card-img-top card_article-picture" alt="">
              <div class="card-body">
                <h5 class="card-title">{{ article.title }}</h5>
                <p class="card-text card_article-text">{{ article.preview }}</p>
                <p>Дата публикации: {{ article.created_at }}</p>
                <router-link :to="{name: 'ArticleShowOne', params:{id: article.id}}">
                  <my-button class="btn-primary">Подробнее</my-button>
                </router-link>
                <div class="mt-3">

                  <span class="badge bg-primary me-2">{{ article.statistic["likes"] }} <i class="bi bi-hand-thumbs-up"></i></span>
                  <span class="badge bg-danger me-2">{{ article.statistic["views"] }} <i class="bi bi-eye"></i></span>

                </div>
                <div class="mt-4">
                  Теги:
                  <a href="#" class="badge bg-danger me-2" v-for="tag in article.tags" :key="tag.id">{{ tag.label }}</a>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="blog-pagination col-xl-12 d-flex justify-content-center">
          <Pagination v-if="search_input == ''"
            :pagination_url="pagination_url"
            v-on:set-paginate-items="setPaginateArticles"
          ></Pagination>
        </div>

      </div>
    </div>
  </div> 

</template>

<script>
import axios from "../../../../axios/axios-instance";
import Pagination from "../../ui/Pagination.vue"

export default {
  name: "ArticlesShow",
  components: {
    Pagination
  },
  data() {
    return {
      // articles: {},
      pagination_url: "http://127.0.0.1:8000/api/articles",
      search_input: "",
      filter_tag: ""
    }
  },
  created() {
    this.$store.dispatch("articles/getArticles")
    this.$store.dispatch("articles/getTags")
  },
  methods: {
    setPaginateArticles(articles) {
      this.$store.commit("articles/setArticlesList", articles.data.data , { root: true })
    },
  
    getArticlesBySearch() {
      if (this.search_input !== '') {
        this.isShowResultSatus = true
        this.$store.dispatch("articles/getArticlesBySearch", this.search_input)
      } else {
        this.isShowResultSatus = false
      }
    },
  },
  computed: {
    getArticles: {
      get() {
        return this.$store.state.articles.articlesList
      }
    },
    getTags: {
      get() {
        return this.$store.state.articles.tagList
      }
    }
  },
}
</script>



<style scoped lang="scss">

.custom-container-crud {
    background-color: rgb(255, 255, 255);
    border-radius: 15px;
    padding: 30px;
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