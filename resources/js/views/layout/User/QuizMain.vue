<template>
  <div class="container custom-container-crud mt-3">
    
    <div class="blog-panel-title col-xl-12 d-flex justify-content-between align-items-center ps-3">
      <h1>Тестирование</h1>
      <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
    </div>

    <quiz @quiz-completed="handleQuizCompleted" :key="quizKey" />

    <custom-modal
      v-show="showModal"
      header="Тест окончен!"
      :score="score"
      @reload="updateQuiz"
      @close="showModal = false"
    />

  </div>
</template>

<script>
import CustomModal from "./CustomModal.vue";
import Quiz from "./Quiz.vue";

export default {
  components: { Quiz, CustomModal },
  name: "QuizMain",
  data() {
    return {
      quizKey: 0,
      showModal: false,
      score: {
        allQuestions: 0,
        answeredQuestions: 0,
        correctlyAnsweredQuestions: 0,
      },
    };
  },
  methods: {
    handleQuizCompleted(score) {
      this.score = score;
      this.showModal = true;
    },
    updateQuiz() {
      this.showModal = false;
      this.quizKey++;
    },
  },
};
</script>

<style>

</style>
