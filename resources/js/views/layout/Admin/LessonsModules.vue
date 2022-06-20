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
              <router-link 
                :to="{name: 'LessonCreate', params:{id: this.$route.params.id}}"
                v-if="authUser.role == 'Master'"
                >
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

            <div class="col-xl-6 col-sm-12 mb-3" v-for="(lesson, idx) in getLessons" :key="lesson.id">
              <div class="card card_course">
                <img src="" class="card-img-top card_course-picture" alt="">
                <div class="card-body">

                  <div class="card-label d-flex justify-content-between align-items-center pb-2">
                    <div class="col-xl-10">
                      <img src="https://via.placeholder.com/150/F5EFFF/000000/?text=FSK" alt="">
                    </div>
                    <div class="col-xl-2">             
                      <h3 class=""><strong>{{ idx + 1 }}</strong></h3>
                    </div>
                  </div>

                  <div class="row d-flex justify-content-between align-items-center">
                    <div class="col-xl-10">
                      <h5 class="card-title">{{ lesson.title }}</h5>
                    </div>
                    <div class="col-xl-2">
                      <span class="badge bg-primary">Активен</span>
                    </div>
                  </div>
                  <hr>

                  <div class="card__buttons d-flex justify-content-between align-items-center flex-wrap">

                    <router-link :to="{name: 'LessonShowOne', params:{course: this.$route.params.id, lesson: lesson.id}}"
                    >
                        <my-button class="btn btn-outline-success mb-2"
                          >Открыть
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-hand-index-thumb" viewBox="0 0 16 16">
                            <path d="M6.75 1a.75.75 0 0 1 .75.75V8a.5.5 0 0 0 1 0V5.467l.086-.004c.317-.012.637-.008.816.027.134.027.294.096.448.182.077.042.15.147.15.314V8a.5.5 0 0 0 1 0V6.435l.106-.01c.316-.024.584-.01.708.04.118.046.3.207.486.43.081.096.15.19.2.259V8.5a.5.5 0 1 0 1 0v-1h.342a1 1 0 0 1 .995 1.1l-.271 2.715a2.5 2.5 0 0 1-.317.991l-1.395 2.442a.5.5 0 0 1-.434.252H6.118a.5.5 0 0 1-.447-.276l-1.232-2.465-2.512-4.185a.517.517 0 0 1 .809-.631l2.41 2.41A.5.5 0 0 0 6 9.5V1.75A.75.75 0 0 1 6.75 1zM8.5 4.466V1.75a1.75 1.75 0 1 0-3.5 0v6.543L3.443 6.736A1.517 1.517 0 0 0 1.07 8.588l2.491 4.153 1.215 2.43A1.5 1.5 0 0 0 6.118 16h6.302a1.5 1.5 0 0 0 1.302-.756l1.395-2.441a3.5 3.5 0 0 0 .444-1.389l.271-2.715a2 2 0 0 0-1.99-2.199h-.581a5.114 5.114 0 0 0-.195-.248c-.191-.229-.51-.568-.88-.716-.364-.146-.846-.132-1.158-.108l-.132.012a1.26 1.26 0 0 0-.56-.642 2.632 2.632 0 0 0-.738-.288c-.31-.062-.739-.058-1.05-.046l-.048.002zm2.094 2.025z"/>
                          </svg>
                          </my-button>
                    </router-link>

                    <router-link 
                      
                      :to="{name: 'LessonEdit', params:{course: this.$route.params.id, lesson: lesson.id}}"
                      v-if="authUser.role == 'Master'"
                    >
                        <my-button class="btn btn-outline-warning mb-2"
                          >Редактировать
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                              <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                              <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                            </svg> 
                        </my-button>
                    </router-link>

                    <router-link :to="'/'"
                      v-if="authUser.role == 'Master'">
                        <my-button class="btn btn-outline-danger mb-2"
                          >Архивироавать
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-server" viewBox="0 0 16 16">
                            <path d="M1.333 2.667C1.333 1.194 4.318 0 8 0s6.667 1.194 6.667 2.667V4c0 1.473-2.985 2.667-6.667 2.667S1.333 5.473 1.333 4V2.667z"/>
                            <path d="M1.333 6.334v3C1.333 10.805 4.318 12 8 12s6.667-1.194 6.667-2.667V6.334a6.51 6.51 0 0 1-1.458.79C11.81 7.684 9.967 8 8 8c-1.966 0-3.809-.317-5.208-.876a6.508 6.508 0 0 1-1.458-.79z"/>
                            <path d="M14.667 11.668a6.51 6.51 0 0 1-1.458.789c-1.4.56-3.242.876-5.21.876-1.966 0-3.809-.316-5.208-.876a6.51 6.51 0 0 1-1.458-.79v1.666C1.333 14.806 4.318 16 8 16s6.667-1.194 6.667-2.667v-1.665z"/>
                          </svg>
                        </my-button>
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
    authUser() {
      return this.$store.state.auth.authUser
    },
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