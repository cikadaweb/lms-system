<template>

  <div class="container">
    <div class="row pt-3">
      
      <div class="col-xl-12 d-flex pb-3">

        <div class="pe-5">
          <h2>Все статьи:</h2>
        </div>

        <div>
          <router-link :to="'/article/create'">
            <my-button class="btn-success">Добавить статью</my-button>
          </router-link>
        </div>

      </div>
      
      <div class="col-xl-12">
        <nav class="table-nav d-flex justify-content-between">
                <div>
                  <form class="d-flex pe-3">
                      <input class="form-control me-2 table-nav__input" type="search" placeholder="Найти" aria-label="Search">
                  </form>
                </div>
                <div class="table-nav-selects">
                  <select class="form-select table-nav__select me-2" aria-label="Default select example">
                    <option selected>Все даты</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>

                  <select class="form-select table-nav__select" aria-label="Default select example">
                    <option selected>Статус</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
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
            <tr v-for="(article, idx) in getArticles" :key="article.id">
              <th>{{ idx + 1 }}</th>
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

      <div class="col-xl-12">
        <nav aria-label="Page navigation example" class="articles-pagination">
          <ul class="pagination">
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
              </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
              <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>

    </div>
  </div>

</template>



<script>
import axios from "../../../../axios/axios-instance";

export default {
  
  name: "ArticlesDashboard",
  components: {

  },
  data() {
    return {

    }
  },
  created() {
    this.$store.dispatch("articles/getArticles")
  },
  methods: {

    // addUser() {
    //   this.$store.dispatch("users/addUser", this.user)
    // },
  
    deleteArticle(id) {
      axios.delete("/api/articles/" + id)
        .then((response) => {
          this.$store.dispatch("articles/getArticles")
      })
    },

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
    background-color: #F5EFFF;
  }

  .articles-pagination {
    display: flex;
    justify-content: center;
  }
  

</style>