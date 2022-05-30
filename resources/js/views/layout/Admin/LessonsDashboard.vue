<template>

  <div class="container">
    <div class="row pt-3">
      
      <div class="col-xl-12">

        <div class="dashboard-panel__title row pt-2">
          <div class=" col-xl-12">

            <ul class="nav nav-tabs dashboard-panel__menu">
              <li class="nav-item">
                <a class="nav-link" 
                  :class="currentTab == 'about' ? 'link-active' : ''" 
                  @click.prevent="chooseTab($event, 'about')"
                  >О курсе</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" 
                  :class="currentTab == 'modules' ? 'link-active' : ''" 
                  @click.prevent="chooseTab($event,'modules')"
                >Модули</a>
              </li>

              <li class="nav-item">
                <a class="nav-link" 
                  @click.prevent="chooseTab($event,'test')"
                  :class="currentTab == 'test' ? 'link-active' : ''"
                >Тест</a>
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
    chooseTab(event, tab) {
      this.currentTab = tab
      console.log(tab)
      console.log(event)
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
  background-color: white;
  color: black;
  font-size: 20px;
  

  &:hover {
    border-bottom: 3px solid #3eaf7c;
  }
}

.link-active {
  border-bottom: 3px solid #3eaf7c;
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