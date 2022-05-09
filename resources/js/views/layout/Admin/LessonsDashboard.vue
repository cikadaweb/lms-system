<template>

  <div class="container">
    <div class="row pt-3">
      
      <div class="col-xl-12 d-flex pb-3">

        <div class="pe-5">
          <h2>Модули курса {{ this.$route.params.id }}:</h2>
        </div>

        <div class="pe-5">
          <router-link :to="'/course/create'">
            <my-button class="btn-success">Добавить модуль</my-button>
          </router-link>
        </div>

      </div>

      <div class="row mt-2">

        <div class="col-4 pb-3" v-for="lesson in lessonsList" :key="lesson.id">

          <div class="card card_course">
            <img src="" class="card-img-top card_course-picture" alt="">
            <div class="card-body">
              <h5 class="card-title">{{ lesson.title }}</h5>
              <p class="card-text card_course-text">{{ lesson.body }}</p>
              <p>130ч</p>

              <div class="card__buttons d-flex justify-content-between">
                <router-link :to="{name: 'LessonsMain', params:{id: course.id}}">
                  <my-button class="btn btn-outline-primary">Открыть</my-button>
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

</template>

<script>

export default {
  name: "LessonsDashboard",
  data() {
    return {

    }
  },
  mounted() {
    this.$store.dispatch("lessons/getLessons")
  },
  computed: {
    getLessons: {
      get() {
        return this.$store.state.lessons.lessonsList
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