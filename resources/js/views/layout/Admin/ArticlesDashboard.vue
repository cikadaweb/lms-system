<template>

  <div class="container">
    <div class="row pt-3">
      <div class="col-xl-12">

        <div class="dashboard-panel-title row pt-2">
          <div class=" col-xl-12">
            <h1>Статьи</h1>
          </div>
        </div>

        <div class="dashboard-panel-filter row pt-3">  
          <div class=" col-xl-12 d-flex justify-content-between flex-wrap">

              <div class="panel-filter-left">
                <form class="d-flex mb-2">
                  <input class="form-control panel-input" v-model="search_input" @input="getArticlesBySearch" type="search" placeholder="Найти статью" aria-label="Search">
                  <button class="btn btn-primary" @click.prevent type="submit"><i class="bi bi-search"></i></button>
                </form>
              </div>

              <div class="panel-filter-right d-flex flex-wrap">

                <select 
                  class="form-select me-5 mb-2"
                  v-model="filter_status"
                  @change="filterArticlesByStatus"
                >
                  <option value="" selected>Статус </option>
                  <option value="1">Опубликован</option>
                  <option value="0">Неопубликован</option>
                </select>

                <select 
                  class="form-select mb-2" 
                  v-model="filter_tag" 
                  @change="filterArticlesByTag"
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
        </div>

        <div class="dashboard-panel-buttons row pt-3">
          <div class="col-xl-12 d-flex justify-content-between flex-wrap">

            <div class="pe-5">
              <router-link :to="'/article/create'">
                <my-button class="btn-success me-3 mb-2">
                  <span class="me-3">Добавить статью </span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                    <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                  </svg>
                </my-button>
              </router-link>

              <router-link :to="'/articles'">
                <my-button class="btn-primary mb-2">
                  <span class="me-3">Все статьи</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-newspaper" viewBox="0 0 16 16">
                    <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                    <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                  </svg>
                </my-button>
              </router-link>
            </div>

            <div class="dashboard-panel__btn table-btn ps-2">
              <my-button class="btn-primary" @click="exportAllArticles">
                <span class="me-3">Экспорт статей </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-xls" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM6.472 15.29a1.176 1.176 0 0 1-.111-.449h.765a.578.578 0 0 0 .254.384c.07.049.154.087.25.114.095.028.202.041.319.041.164 0 .302-.023.413-.07a.559.559 0 0 0 .255-.193.507.507 0 0 0 .085-.29.387.387 0 0 0-.153-.326c-.101-.08-.255-.144-.462-.193l-.619-.143a1.72 1.72 0 0 1-.539-.214 1.001 1.001 0 0 1-.351-.367 1.068 1.068 0 0 1-.123-.524c0-.244.063-.457.19-.639.127-.181.303-.322.527-.422.225-.1.484-.149.777-.149.305 0 .564.05.78.152.216.102.383.239.5.41.12.17.186.359.2.566h-.75a.56.56 0 0 0-.12-.258.625.625 0 0 0-.247-.181.923.923 0 0 0-.369-.068c-.217 0-.388.05-.513.152a.472.472 0 0 0-.184.384c0 .121.048.22.143.3a.97.97 0 0 0 .405.175l.62.143c.217.05.406.12.566.211a1 1 0 0 1 .375.358c.09.148.135.335.135.56 0 .247-.063.466-.188.656a1.216 1.216 0 0 1-.539.439c-.234.105-.52.158-.858.158-.254 0-.476-.03-.665-.09a1.404 1.404 0 0 1-.478-.252 1.13 1.13 0 0 1-.29-.375Zm-2.945-3.358h-.893L1.81 13.37h-.036l-.832-1.438h-.93l1.227 1.983L0 15.931h.861l.853-1.415h.035l.85 1.415h.908L2.253 13.94l1.274-2.007Zm2.727 3.325H4.557v-3.325h-.79v4h2.487v-.675Z"/>
                </svg>
              </my-button>
            </div>

          </div>
        </div>

        <div class="dashboard-panel-results row">   
          <div class="col-xl-12" v-if="isShowResultSatus">
            <div class="pt-3" v-if="getArticles.length > 0">
              <h2>Результаты по запросу: {{ search_input }}</h2>
              <p class="lead">Всего найдено {{ getArticles.length }} постов.</p>
            </div>
            <div class="pt-3" v-else >
              <h2>По запросу {{ search_input }} ничего не найдено.</h2>
              <a href="" @click.prevent="clearSearchInput()">Отобразить все посты</a>
            </div>
          </div>
        </div>

        <AppLoader v-if="loading"></AppLoader>

        <div v-else class="dashboard-panel-table row">
          <div class="col-xl-12 table-responsive">
            <table v-if="getArticles.length != 0" class="table table-light table-striped">
              <thead>
                <tr>
                  <th class="tabel-label">ID</th>
                  <th class="tabel-label">Название</th>
                  <th class="tabel-label">Просмотры</th>
                  <th class="tabel-label">Теги</th>
                  <th class="tabel-label">Дата создания</th>
                  <th class="tabel-label">Активность</th>
                  <th class="tabel-label">Перейти</th>
                  <th class="tabel-label">Редактировать</th>
                  <th class="tabel-label">Удалить</th>
                </tr>
              </thead>
              <tbody >
                <tr v-for="article in getArticles" :key="article.id">
                  <th>{{ article.id }}</th>
                  <td>{{ article.title }}</td>
                  <td>{{ article.statistic["views"] }}</td>
                  <td>
                    <span v-for="tag in article.tags" :key="tag.id" class="badge bg-primary">
                      {{ tag.label }}
                    </span>
                  </td>
                  <td>{{ article.created_at }}</td>
                  <td v-if="article.is_active == 1">Опубликован</td>
                  <td v-else>Неопубликован</td>
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

            <div class="table-pagination col-xl-12 d-flex justify-content-center">
              <Pagination v-if="search_input == ''"
                :pagination_url="pagination_url"
                v-on:set-paginate-items="setPaginateArticles"
              ></Pagination>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

</template>



<script>
import axios from "../../../../axios/axios-instance";
import Pagination from "../../ui/Pagination.vue"
import AppLoader from "../../ui/AppLoader.vue";

export default {
  
  name: "ArticlesDashboard",
  components: {
    Pagination,
    AppLoader
  },
  data() {
    return {
      pagination_url: "http://127.0.0.1:8000/api/articles",
      search_input: "",
      filter_status: "",
      filter_tag: "",
      isShowResultSatus: false
    }
  },
  created() {
    this.$store.dispatch("articles/getArticles")
    this.$store.dispatch("articles/getTags")
  },
  methods: {

    deleteArticle(id) {
      this.$store.dispatch("articles/deleteArticle", id)
      this.$store.dispatch("articles/getArticles")
    },

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
    clearSearchInput() {
      this.search_input = ""
      this.isShowResultSatus = false
      this.$store.dispatch("articles/getArticles")
    },

    filterArticlesByStatus() {
      this.$store.dispatch("articles/filterArticlesByStatus", this.filter_status)
    },

    filterArticlesByTag() {
      this.$store.dispatch("articles/filterArticlesByTag", this.filter_tag)
    },
    exportAllArticles() {
      this.$store.dispatch("articles/exportAllArticles")
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
    },
    loading: {
      get() {
        return this.$store.state.articles.loading
      }
    }
  }
}
</script>



<style scoped lang="scss">
.tabel-label {
  background-color: #F5EFFF !important;
}
</style>