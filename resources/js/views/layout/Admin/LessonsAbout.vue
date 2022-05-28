<template>
  <div class="container custom-container-crud mt-3">
    
    <div class="dashboard-panel__title col-xl-12 pt-2">
      <h1>О курсе {{ this.$route.params.id }}:</h1>
      <h4 v-html="getCurrentCourse.description" class="course__description mt-3"></h4>
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
    this.$store.dispatch("courses/getCourseData", this.$route.params.id)
  },
  computed: {
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

<style>

</style>
