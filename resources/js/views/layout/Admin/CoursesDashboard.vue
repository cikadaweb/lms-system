<template>

  <div class="container">
    <div class="row pt-3">
      
      <div class="dashboard-panel__title col-xl-12 pt-2">
        <h1>Курсы</h1>
      </div>

      <div class="dashboard-panel-filter col-xl-12 d-flex justify-content-between pt-3">
          <div class="panel-filter-left">
            <form class="d-flex">
              <input class="form-control panel-input" v-model="search_input" @input="getCoursesBySearch" type="search" placeholder="Наименование курса" aria-label="Search">
              <button class="btn btn-primary" @click.prevent type="submit"><i class="bi bi-search"></i></button>
            </form>
          </div>

          <div class="panel-filter-right d-flex">

            <select class="form-select me-5">
              <option selected>Статус курса</option>
              <option value="1">Опубликован</option>
              <option value="2">Неопубликован</option>
            </select>

            <!-- <select 
              class="form-select" 
              aria-label="Роль"
              v-model="filter_role" 
              @change="filterUsersByStatus"
            >
              <option value="" selected>Роль </option>
              <option 
              v-for="role in getRoles"
              :key="role.id" 
              :value="role.name"
              >{{ role.name }}</option>
            </select> -->

          </div>
      </div>

      <div class="dashboard-panel-buttons col-xl-12 d-flex justify-content-between pt-3">

        <router-link :to="'/course/create'" v-if="authUser.role == 'Master'">
          <my-button class="btn-success">
            <span class="me-3">Создать курс</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
              <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
              <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
          </my-button>
        </router-link>

      </div>

      <div class="dashboard-panel-results" v-if="isShowResultSatus">
        <div class="pt-3" v-if="getCourses.length > 0">
          <h2>Результаты по запросу: {{ search_input }}</h2>
          <p class="lead">Всего найдено {{ getCourses.length }} курсов.</p>
        </div>
        <div class="pt-3" v-else >
          <h2>По запросу {{ search_input }} ничего не найдено.</h2>
          <a href="" @click.prevent="clearSearchInput()">Отобразить все курсы</a>
        </div>
      </div>

      <AppLoader v-if="loading"></AppLoader>

      <div v-else class="dashboard-panel-courses row mt-5">
        <div class="col-6 pb-3" v-for="course in getCourses" :key="course.id">

          <div class="card card_course">
            <img :src="`${course.img}`" class="card-img-top card_course-picture" alt="">

            <div class="card-body">
              <h5 class="card-title">{{ course.title }}</h5>
              <p class="card-text card_course-text">{{ course.preview }}</p>
              <p>Продолжительность: 8 часов</p>

              <div class="card__buttons d-flex justify-content-between">
                <router-link :to="{name: 'LessonsMain', params:{id: course.id, title: course.title}}">
                  <my-button class="btn btn-outline-primary">Открыть</my-button>
                </router-link>

                <router-link :to="'/'" v-if="authUser.role == 'Master'">
                  <my-button class="btn btn-outline-danger">Архивироавать</my-button>
                </router-link>
              </div>
            </div>
            
          </div>

        </div>
      </div>
      
    </div>
  </div>

</template>

<script>
import AppLoader from "../../ui/AppLoader.vue";

export default {
  name: "CoursesDashboard",
  components: {AppLoader},
  data() {
    return {
      search_input: "",
      isShowResultSatus: false,
    }
  },

  mounted() {
    this.$store.dispatch("courses/getCourses")
  },

  methods: {

    clearSearchInput() {
      this.search_input = ""
      this.isShowResultSatus = false
      this.$store.dispatch("courses/getCourses")
    },

    getCoursesBySearch() {
      if (this.search_input !== '') {
        this.isShowResultSatus = true
        this.$store.dispatch("courses/getCoursesBySearch", this.search_input)
      } else {
        this.isShowResultSatus = false
      }
    },
  
  },

  computed: {
    authUser() {
      return this.$store.state.auth.authUser
    },
    getCourses: {
      get() {
        return this.$store.state.courses.coursesList
      }
    },
    loading: {
      get() {
        return this.$store.state.courses.loading
      }
    }
  }
}
</script>



<style scoped lang="scss">

.card_course-picture {
  padding: 10px;
  max-height: 300px;
  object-fit: contain;
}

.card_course-text {
    height: 100px;
    text-indent: 5%;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>