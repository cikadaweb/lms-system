<template>
  <div class="container custom-container-crud mt-3">
    
    <div class="blog-panel-title col-xl-12 d-flex justify-content-between align-items-center ps-3">
      <h1>Модули</h1>
      <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
    </div>

    <div class="dashboard-panel-buttons row pt-3">
      <div class=" col-xl-12 d-flex justify-content-between ">
        <div class="dashboard-panel__btn table-btn ps-2">
          <router-link :to="{name: 'LessonCreate', params:{id: this.$route.params.id}}">
            <my-button class="btn-success">Добавить модуль</my-button>
          </router-link>
        </div>
      </div>
    </div>

      <!-- <AppLoader v-if="loading"></AppLoader> -->

      <div class="dashboard-panel__lessons row pt-3">
        <div class="col-6 mb-3" v-for="(lesson, idx) in getLessons" :key="lesson.id">

          <div class="card card_course">
            <img src="" class="card-img-top card_course-picture" alt="">
            <div class="card-body">

              <div class="card-label d-flex justify-content-between align-items-center pb-2">
                <img src="https://via.placeholder.com/150/F5EFFF/000000/?text=FSK" alt="">
                <span class="card-label__text">{{ idx + 1 }}</span>
              </div>

              <h5 class="card-title">{{ lesson.title }}</h5>
              <hr>

              <div class="card__buttons d-flex justify-content-between">
                <router-link :to="{name: 'LessonShowOne', params:{lesson: lesson.id, course: this.$route.params.id}}">
                  <my-button class="btn btn-outline-success">Открыть</my-button>
                </router-link>

                <router-link :to="'/'">
                  <my-button class="btn btn-outline-danger">Архивироавать</my-button>
                </router-link>
              </div>

            </div>
          </div>

        </div>
      </div>

  </div>
</template>

<script>


export default {
  components: {  },
  name: "LessonsModules",
  data() {
    return {

    }
  },
  methods: {

  },
  mounted() {
    this.$store.dispatch("lessons/getLessons", this.$route.params.id)
  },
  computed: {
    getLessons: {
      get() {
        return this.$store.state.lessons.lessonsList
      }
    },
    loading: {
      get() {
        return this.$store.state.lessons.loading
      }
    }
  }
};
</script>

<style>

</style>
