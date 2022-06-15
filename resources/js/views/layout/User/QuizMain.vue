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
      console.log("Количество правильных ответов: ", this.score.correctlyAnsweredQuestions)
      // fetch("/api/questions/", {
      //   method: "POST",
      //   headers: {
      //     "Content-Type" : "application/json"
      //   },
      //   body: JSON.stringify({
      //     score_percentage: 80,
      //     score_count: 5,
      //     user_id: 35,
      //     test_id: 2
      //   })
      // })

      let data = await response.json()
      console.log(data)
    }

  },
};
</script>

<style>

</style>
