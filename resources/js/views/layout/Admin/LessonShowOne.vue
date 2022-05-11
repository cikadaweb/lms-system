<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">

        <div class="nav">
          <div>
            <h2>Идентификатор урока {{ this.$route.params.lesson }}</h2>
          </div>
          <div>
            <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
          </div>
        </div>

        <form>
          <div class="mb-3">
            <label for="lessonTitle" class="form-label"><strong>Тема урока: </strong></label>
            <p>{{ lesson.title }}</p>
          </div>

          <div class="mb-3">
            <label for="lessonBody" class="form-label"><strong>Лекция</strong></label>
             <p class="lesson-body pt-5" v-html="lesson.body"></p>
          </div>

          <div class="form-group">
              <label for="feature_image"><strong>Изображение статьи *</strong></label>
              <img src="" alt="" class="img-uploaded" style="display: block; width: 300px">
              <input type="text" class="form-control" id="feature_image" name="feature_image" value="" readonly :class="{invalid: errors.img}">

              <small v-if="errors.img" class="form-small">{{ errors.img }}</small>

              <button type="button" class="btn btn-primary mt-3 mb-3">
                <a href="" class="popup_selector" style="color: white;" data-inputid="feature_image"><strong>Выберите файл</strong></a>
              </button>
              <span class="form-span">Поддерживаемые форматы: jpg/jpeg/png</span>
          </div>

          <div class="form-buttons">
            <router-link to="/" class="btn btn-outline-danger me-3"> Предыдущий урок </router-link>
            <router-link to="/" class="btn btn-outline-success me-3"> Следующий урок </router-link>
          </div>

        </form>

      </div>

    </div>
  </div>



</template>

<script>
// import ViewsState from "../../ui/ViewsState.vue"
// import Comments from "../../ui/Comments.vue"

export default {
  // components: { LikesState, ViewsState, Comments },

  name: "LessonShowOne",
  data() {
    return {
      currentLessonId: "",
      errors: {
        title: null,
        preview: null,
        body: null,
        img: null
      }
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

  },
  mounted() {
     this.$store.dispatch("lessons/getLessonData", this.$route.params.lesson)
     this.currentLessonId = this.$route.params.lesson
  },

}
</script>



<style lang="scss">

.custom-container-crud {
    background-color: rgb(255, 255, 255);
    border-radius: 15px;
    padding: 30px;
}

.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
}



</style>