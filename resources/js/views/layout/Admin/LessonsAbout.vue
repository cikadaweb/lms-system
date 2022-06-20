<template>
  <div class="container custom-container-crud">
    <div class="row">
      <div class="col-xl-12">

        <div class="dashboard-panel-title row pt-2">
          <div class=" col-xl-12">
            <h1>{{ this.$route.params.title }}</h1>
          </div>
        </div>

        <div class="dashboard-panel-buttons row pt-3">
          <div class="col-xl-12 d-flex justify-content-between">

            <div class="pe-5">
              <router-link :to="{name: 'CourseEdit', params:{id: this.$route.params.id}}" v-if="authUser.role == 'Master'">
                <my-button class="btn-success me-3 mb-2">
                  <span class="me-3">Редактировать курс </span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square side-nav__link-icon" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                  </svg>
                </my-button>
              </router-link>

              <router-link :to="{name: 'CourseQuizCreate', params:{id: this.$route.params.id}}" v-if="authUser.role == 'Master'">
                <my-button class="btn-primary mb-2">
                  <span class="me-3">Добавить вопросы к тесту</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-text-fill side-nav__link-icon" viewBox="0 0 16 16">
                    <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM4.5 5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1h-7zm0 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4z"/>
                  </svg>
                </my-button>
              </router-link>
            </div>

          </div>
        </div>

        <div class="dashboard-panel-content row pt-3">
          <div class="col-xl-12">
            <h4 v-html="getCurrentCourse.description" class="course__description mt-3"></h4>
          </div>
        </div>


      </div>
    </div>
  </div>
</template>

<script>


export default {
  components: { },
  name: "LessonsModules",
  data() {
    return {

    }
  },
  methods: {

  },
  mounted() {
    this.$store.dispatch("courses/getCourseData", this.$route.params.id)
  },
  computed: {
    authUser() {
      return this.$store.state.auth.authUser
    },
    getCurrentCourse: {
      get() {
        return this.$store.state.courses.currentCourse
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


