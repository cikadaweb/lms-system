<template>

  <div class="container">
    <div class="row pt-3">
      
      <h2>Все статьи:</h2>

      <div class="table-btn pt-2 pb-3">
        <router-link :to="'/article/create'">
          <my-button class="btn-success">Добавить статью</my-button>
        </router-link>

      </div>

      <table class="table table-primary table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Название</th>
            <th scope="col">Просмотры</th>
            <th scope="col">Дата создания</th>
            <th>Перейти</th>
            <th>Редактировать</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody >
          <tr v-for="(article, idx) in getArticles" :key="article.id">
            <th>{{ idx }}</th>
            <td>{{ article.title }}</td>
            <td>12</td>
            <td>{{ article.created_at }}</td>
            <td>
                <router-link :to="'/'">
                  <my-button class="btn-success">Открыть</my-button>
                </router-link>
            </td>
            <td>
                <router-link :to="'/'">
                  <my-button class="btn-warning">Редактировать</my-button>
                </router-link>
            </td>
            <td>
                <my-button class="btn-danger">Удалить</my-button>
            </td>
          </tr>
        </tbody>
      </table>

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
      user: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        role: {
          name: "",
        }
      }
    }
  },
  created() {
    this.$store.dispatch("articles/getArticles")
  },
  methods: {

    // addUser() {
    //   this.$store.dispatch("users/addUser", this.user)
    // },
  
    // deleteUser(id) {
    //   axios.delete("/api/users/" + id)
    //     .then((response) => {
    //       this.$store.dispatch("users/getUsers")
    //   })
    // },

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

  .table-btn{
    display: flex;
  }
  

</style>