<template>

  <div class="container custom-container-crud">
    <div class="row pt-3 pb-3">
      <div class="col-xl-12">

        <div class="dashboard-panel__title row">
          <div class="nav col-xl-12">
            <div>
              <h2>Идентификатор урока {{ this.$route.params.lesson }}</h2>
            </div>
            <div>
              <router-link :to="`/course-id${this.$route.params.course}/lessons`"><h5><i class="bi bi-arrow-left-circle"></i> Вернуться к курсу</h5></router-link>
            </div>
          </div>
        </div>

      <AppLoader v-if="loading"></AppLoader>

        <div v-else class="dashboard-panel__content row pt-3">
          <form class="col-xl-12">
            <div class="mb-3">
              <label for="lessonTitle" class="form-label"><h4><strong>Тема урока: </strong></h4></label>
              <p>{{ lesson.title }}</p>
            </div>

            <div class="mb-3">
              <label for="lessonBody" class="form-label"><h4><strong>Лекция</strong></h4></label>
              <p class="lesson-body" v-html="lesson.body"></p>
            </div>

            <div class="form-group">
                <a class="btn btn-success" href="/files\course_1\test_1.pdf" role="button" download="">Скачать урок</a>
            </div>


            <div class="form-buttons">
              <router-link to="/" class="btn btn-outline-danger me-3"> Предыдущий урок </router-link>
              <router-link to="/" class="btn btn-outline-success me-3"> Следующий урок </router-link>
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>



</template>

<script>

import AppLoader from "../../ui/AppLoader.vue";

export default {
  name: "LessonShowOne",
  components: {AppLoader},
  data() {
    return {
      currentLessonId: "",
      errors: {
        title: null,
        preview: null,
        body: null,
        img: null
      },
    }
  },
  computed: {
    lesson: {
      get() {
        return this.$store.state.lessons.currentLesson
      }
    },
    lessonList: {
      get() {
        return this.$store.state.lessons.lessonsList
      }
    },
    loading: {
      get() {
        return this.$store.state.lessons.loading
      }
    }
  },
  mounted() {
     this.$store.dispatch("lessons/getLessonData", this.$route.params.lesson)
     this.currentLessonId = this.$route.params.lesson
  },

}
</script>



<style lang="scss">

.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.lesson-btn {
  color: white;
}


</style>