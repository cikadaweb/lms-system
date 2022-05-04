<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">
        <div class="nav">
          <h2>Новости:</h2>
          <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
        </div>
      </div>

      <div class="col-xl-12">
        <nav class="table-nav d-flex justify-content-between">
          
                <div>
                  <form class="d-flex pe-3">
                      <input v-model="search_input" @input="getArticlesBySearch" class="form-control me-2 table-nav__input" type="search" placeholder="Найти" aria-label="Search">
                  </form>
                </div>

                <div class="table-nav-selects">
                  <select class="form-select table-nav__select me-2" aria-label="Default select example">
                    <option selected disabled>Статус статьи</option>
                    <option value="1">active</option>
                    <option value="2">disable</option>
                  </select>

                  <select class="form-select table-nav__select" aria-label="Default select example">
                    <option selected disabled>Теги</option>
                    <option v-for="tag in getTags" :key="tag.id" :value="tag.id">{{ tag.label }}</option>
                  </select>

                </div>
        </nav>
      </div>

      <div class="col-xl-12">
        <div class="row mt-5">

          <div class="col-6 pb-3" v-for="article in articles" :key="article.id">
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
      </div>

      <div class="col-xl-12 d-flex justify-content-center">
        <Pagination 
          :pagination_url="pagination_url"
          v-on:set-paginate-items="setPaginateArticles"
        ></Pagination>
      </div>

    </div>
  </div> 

</template>

<script>
import axios from "../../../../axios/axios-instance";
import Pagination from "../../ui/Pagination.vue"

export default {
  name: "ArticlesShow",
  created() {
    // this.$store.dispatch("articles/getArticles")
    this.$store.dispatch("articles/getTags")
  },
  components: {
    Pagination
  },
  data() {
    return {
      articles: {},
      pagination_url: "http://127.0.0.1:8000/api/articles",
      search_input: "",
      exact_tag: ""
    }
  },
  computed: {
    // getArticles: {
    //   get() {
    //     return this.$store.state.articles.articlesList
    //   }
    // },
    getTags: {
      get() {
        return this.$store.state.articles.tagList
      }
    }
  },
  methods: {
    setPaginateArticles(articles) {
      if (this.search_input != "") {
        let filterData = articles.data.data.filter((article) => {
          article.title.toLowerCase().includes(this.search_input.toLowerCase())
        })
        this.articles = filterData
      } else {
        this.articles = articles.data.data
      }
    },
    getArticlesBySearch() {
      if (this.search_input !== '') {
        axios.get("/api/articles-search/" + `?searchInput=${this.search_input}`)
          .then((response) => {
            console.log(response.data.data)
            this.articles = response.data.data})
          .catch((error) => {
            console.log(error);
        });
      }
    }
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