<template>

  <div class="container">
    <div class="row pt-3">
      
      <div class="col-xl-12 d-flex pb-3">

        <div class="pe-5">
          <h2>Все статьи:</h2>
        </div>

        <div class="pe-5">
          <router-link :to="'/article/create'">
            <my-button class="btn-success">Добавить статью</my-button>
          </router-link>
        </div>

        <div class="pe-5">
          <router-link :to="'/articles'">
            <my-button class="btn-primary">Все статьи</my-button>
          </router-link>
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
        <table class="table table-light table-striped">
          <thead>
            <tr>
              <th class="tabel-label">ID</th>
              <th class="tabel-label">Название</th>
              <th class="tabel-label">Просмотры</th>
              <th class="tabel-label">Теги</th>
              <th class="tabel-label">Дата создания</th>
              <th class="tabel-label">Перейти</th>
              <th class="tabel-label">Редактировать</th>
              <th class="tabel-label">Удалить</th>
            </tr>
          </thead>
          <tbody >
            <tr v-for="article in articles" :key="article.id">
              <th>{{ article.id }}</th>
              <td>{{ article.title }}</td>
              <td>{{ article.statistic["views"] }}</td>
              <td>
                <span v-for="tag in article.tags" :key="tag.id" class="badge bg-primary">
                  {{ tag.label }}
                </span>
              </td>
              <td>{{ article.created_at }}</td>
              <td>
                  <router-link :to="{name: 'ArticleShowOne', params:{id: article.id}}">
                    <my-button class="btn-success">Открыть</my-button>
                  </router-link>
                  
              </td>
              <td>
                  <router-link :to="{name: 'ArticleEdit', params:{id: article.id}}">
                    <my-button class="btn-warning">Редактировать</my-button>
                  </router-link>
              </td>
              <td>
                  <my-button class="btn-danger" @click="deleteArticle(article.id)"> Удалить</my-button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-xl-12 d-flex justify-content-center">
        <Pagination v-if="search_input == ''"
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
  
  name: "ArticlesDashboard",
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
  created() {
    // this.$store.dispatch("articles/getArticles")
    this.$store.dispatch("articles/getTags")
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
  
    deleteArticle(id) {
      axios.delete("/api/articles/" + id)
        .then((response) => {
          this.$store.dispatch("articles/getArticles")
          this.articles = this.getArticles
      })
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
  }
}
</script>



<style lang="scss">

.table-nav {
  background-color: white;
  padding: 20px;
  border-radius: 15px;
}


.table-nav__items {
  display: flex;
  justify-content: space-between;
}

.table-nav-selects {
  display: flex;
}

.table-nav__input {
    width: 200px;
}

.table-nav__select {
  width: 150px;
}

  .table-btn{
    display: flex;
  }

  .tabel-label {
    background-color: #F5EFFF !important;
  }

  .articles-pagination {
    display: flex;
    justify-content: center;
  }
  

</style>