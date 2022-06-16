<template>
  <div class="container custom-container-crud mt-3">
    
    <div class="blog-panel-title col-xl-12 d-flex justify-content-between align-items-center ps-3">
      <h1>Тестирование</h1>
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
import axios from "../../../../axios/axios-instance";

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

      this.saveCurrentTestScores(this.score) // тут вызываем метод для сохранения результатов

    },
    updateQuiz() {
      this.showModal = false;
      this.quizKey++;
    },
    async saveCurrentTestScores() {
      // console.log("Количество правильных ответов: ", this.score.correctlyAnsweredQuestions)
      let percentage = Math.floor((this.score.correctlyAnsweredQuestions / this.score.allQuestions) *100)
      axios
          .post("/api/scores", {
            score_percentage: percentage,
            score_count: this.score.correctlyAnsweredQuestions,
            user_id: this.authUser.id,
            test_id: this.$route.params.id
          })
          .then((response) => {
              if (response.data) {
                  // отладка
                  console.log("Успешно!")
                  console.log(response)
              }
          })
          .catch((error) => {
              // отладка
              console.log(error.response)
          });
    }

  },
  computed: {
    authUser() {
        return this.$store.state.auth.authUser
    },
  }
};
</script>

<style>

</style>
