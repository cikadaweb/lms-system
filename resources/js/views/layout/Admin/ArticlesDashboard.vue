<template>

  <div class="container">
    <div class="row pt-3">
      
      <!-- <div class="col-xl-12 d-flex pb-3">

        <div class="pe-5">
          <h2>Все статьи:</h2>
        </div>

        <div class="pe-5">
          <router-link :to="'/articles'">
            <my-button class="btn-primary">Все статьи</my-button>
          </router-link>
        </div>

        <div class="pe-5">
          <router-link :to="'/article/create'">
            <my-button class="btn-success">Добавить статью</my-button>
          </router-link>
        </div>

      </div> -->

      <div class="dashboard-panel__title col-xl-12 pt-2">
        <h1>Статьи</h1>
      </div>

      <div class="dashboard-panel-filter col-xl-12 d-flex justify-content-between pt-3">
          <div class="panel-filter-left">
            <form class="d-flex">
              <input class="form-control panel-input" v-model="search_input" @input="getArticlesBySearch" type="search" placeholder="Найти статью" aria-label="Search">
              <button class="btn btn-primary" @click.prevent type="submit"><i class="bi bi-search"></i></button>
            </form>
          </div>

          <div class="panel-filter-right d-flex">

            <select class="form-select me-5" aria-label="Disabled select example" disabled>
              <option selected>Статус </option>
              <option value="1">Один</option>
              <option value="2">Два</option>
              <option value="3">Три</option>
            </select>

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

      <div class="dashboard-panel-buttons col-xl-12 d-flex justify-content-between pt-3">

        <div class="pe-5">
          <router-link :to="'/article/create'">
            <my-button class="btn-success me-3">Добавить статью</my-button>
          </router-link>

          <router-link :to="'/articles'">
            <my-button class="btn-primary">Все статьи</my-button>
          </router-link>
        </div>

        <div class="dashboard-panel__btn table-btn ps-2">
          <my-button class="btn-primary">
             Импорт 
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-xls" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM6.472 15.29a1.176 1.176 0 0 1-.111-.449h.765a.578.578 0 0 0 .254.384c.07.049.154.087.25.114.095.028.202.041.319.041.164 0 .302-.023.413-.07a.559.559 0 0 0 .255-.193.507.507 0 0 0 .085-.29.387.387 0 0 0-.153-.326c-.101-.08-.255-.144-.462-.193l-.619-.143a1.72 1.72 0 0 1-.539-.214 1.001 1.001 0 0 1-.351-.367 1.068 1.068 0 0 1-.123-.524c0-.244.063-.457.19-.639.127-.181.303-.322.527-.422.225-.1.484-.149.777-.149.305 0 .564.05.78.152.216.102.383.239.5.41.12.17.186.359.2.566h-.75a.56.56 0 0 0-.12-.258.625.625 0 0 0-.247-.181.923.923 0 0 0-.369-.068c-.217 0-.388.05-.513.152a.472.472 0 0 0-.184.384c0 .121.048.22.143.3a.97.97 0 0 0 .405.175l.62.143c.217.05.406.12.566.211a1 1 0 0 1 .375.358c.09.148.135.335.135.56 0 .247-.063.466-.188.656a1.216 1.216 0 0 1-.539.439c-.234.105-.52.158-.858.158-.254 0-.476-.03-.665-.09a1.404 1.404 0 0 1-.478-.252 1.13 1.13 0 0 1-.29-.375Zm-2.945-3.358h-.893L1.81 13.37h-.036l-.832-1.438h-.93l1.227 1.983L0 15.931h.861l.853-1.415h.035l.85 1.415h.908L2.253 13.94l1.274-2.007Zm2.727 3.325H4.557v-3.325h-.79v4h2.487v-.675Z"/>
            </svg>
          </my-button>
        </div>

      </div>

      <div class="col-xl-12">

        <div class="pt-3" v-if="articles.length > 0">
          <h2>Результаты по запросу: {{ search_input }}</h2>
          <p class="lead">Всего найдено {{ articles.length }} постов.</p>
        </div>
        <div class="pt-3" v-else >
          <h2>По запросу {{ search_input }} ничего не найдено.</h2>
          <a href="" @click.prevent="search_input = ''">Отобразить все посты</a>
        </div>


        <table class="table table-light table-striped" v-if="articles.length > 0">
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
      filter_tag: ""
    }
  },
  created() {
    // this.$store.dispatch("articles/getArticles")
    this.$store.dispatch("articles/getTags")
  },
  methods: {

    deleteArticle(id) {
      axios.delete("/api/articles/" + id)
        .then((response) => {
          this.$store.dispatch("articles/getArticles")
          this.articles = this.getArticles
      })
    },

    setPaginateArticles(articles) {
      this.articles = articles.data.data
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
    },

    setArticleTag () {
      console.log(this.selected_tag)
    },

    filterArticlesByStatus() {
      console.log("da")
      axios.get("/api/articles-all/")
        .then((response) => {
          console.log(response.data.data)
          // let filterData = response.data.filter((article) => {
          //   return article.tag.name === this.filter_role
          // })
          // this.users = filterData
        })
        .catch((error) => {
          console.log(error);
      });
    },


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

.dashboard-panel-filter {
  background-color: white;
  padding: 20px;
  border-radius: 15px;
}

.form-select {
  background-color: rgb(255, 255, 255);
}

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
  width: 200px;
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