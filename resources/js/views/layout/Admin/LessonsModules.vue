<template>
  <div class="container custom-container-crud">
    <div class="row">
      <div class="col-xl-12">

        <div class="dashboard-panel-title row pt-2">
          <div class=" col-xl-12">
            <h1>Модули</h1>
          </div>
        </div>

        <div class="dashboard-panel-buttons row pt-3">
          <div class="col-xl-12 d-flex justify-content-between">

            <div class="pe-5">
              <router-link :to="{name: 'LessonCreate', params:{id: this.$route.params.id}}">
                <my-button class="btn-success me-3">
                  <span class="me-3">Добавить модуль </span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus side-nav__link-icon" viewBox="0 0 16 16">
                    <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
                    <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                  </svg>
                </my-button>
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
                    <h4 class="card-label__text">{{ idx + 1 }}</h4>
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

<style lang="scss" scoped>

.custom-container-crud {
  margin: 30px 0 30px 0;
}

</style>>