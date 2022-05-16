<template>

  <div class="container">
    <div class="row pt-3">
      
      <div class="col-xl-12 d-flex pb-3">

        <div class="pe-5">
          <h2>Модули курса {{ this.$route.params.id }}:</h2>
        </div>

        <div class="pe-5">
          <router-link :to="{name: 'LessonCreate', params:{id: this.$route.params.id}}">
            <my-button class="btn-success">Добавить модуль</my-button>
          </router-link>
        </div>

      </div>

      <div class="row mt-2">

        <div class="col-4 pb-3" v-for="(lesson, idx) in getLessons" :key="lesson.id">

          <div class="card card_course">
            <img src="" class="card-img-top card_course-picture" alt="">
            <div class="card-body">

              <div class="card-label d-flex justify-content-between align-items-center pb-2">
                <img src="https://via.placeholder.com/150/F5EFFF/000000/?text=FSK" alt="">
                <span class="card-label__text">{{ idx + 1 }}</span>
              </div>

              <h5 class="card-title">{{ lesson.title }}</h5>
              <!-- <p class="card-text card_course-text">{{ lesson.body }}</p> -->
              <hr>

              <div class="card__buttons d-flex justify-content-between">
                <router-link :to="{name: 'LessonShowOne', params:{lesson: lesson.id}}">
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

</template>

<script>

export default {
  name: "LessonsDashboard",
  data() {
    return {

    }
  },
  mounted() {
    this.$store.dispatch("lessons/getLessons", this.$route.params.id)
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

.card_course {
  border-radius: 10px;
}

.card-label__text {
    font-size: 30px;
    padding-right: 70px;
}

</style>