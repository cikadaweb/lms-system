<template>

  <div class="container">
    <div class="row pt-3">
      
      <div class="col-xl-12">

        <div class="dashboard-panel__title row pt-2">
          <div class=" col-xl-12">

            <ul class="nav nav-tabs dashboard-panel__menu">
              <li class="nav-item">
                <a class="nav-link" href="#" @click.prevent="chooseTab('about')">О курсе</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" @click.prevent="chooseTab('modules')">Модули</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" @click.prevent="chooseTab('test')">Тест</a>
              </li>
            </ul>

          </div>
        </div>

        <LessonsAbout
          v-if="currentTab == 'about'"
        ></LessonsAbout>

        <LessonsModules
          v-else-if="currentTab == 'modules'"
        ></LessonsModules>

        <QuizMain
          v-else
        ></QuizMain>

      </div>
    </div>
  </div>

</template>

<script>
import LessonsAbout from "../../layout/Admin/LessonsAbout.vue";
import LessonsModules from "../../layout/Admin/LessonsModules.vue";
import QuizMain from "../../layout/User/QuizMain.vue";

export default {
  name: "LessonsDashboard",
  components: {LessonsAbout, LessonsModules, QuizMain},
  data() {
    return {
      currentTab: "about"
    }
  },
  mounted() {

  },
  methods: {
    chooseTab(tab) {
      this.currentTab = tab
      console.log(tab)
    }
  },
  computed: {

  }
}
</script>



<style scoped lang="scss">

.dashboard-panel__menu {
  background-color: white;
  padding: 15px;
  border-radius: 15px;
}

.nav-link {
  padding: 15px 90px 15px 90px;
  background-color: #CAD4DD;
  color: black;
  border-radius: 20px;
  font-size: 20px;

  &:hover {
    color: white;
    background-color: #007bff;
  }
}

.card_course {
  border-radius: 10px;
}

.card-label__text {
    font-size: 30px;
    padding-right: 70px;
}

.course__description {
  background-color: white;
  padding: 20px;
  border-radius: 15px;
}

</style>