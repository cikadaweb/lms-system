<template>

  <div class="container custom-container-crud mt-5">
    <div class="row pt-3">
      <div class="col-xl-12">

        <div class="dashboard-panel-title row">
          <div class="col-xl-12">
              <div class="nav">
              <h2>Добавление вопроса для теста</h2>
              <router-link :to="`/course-id${this.$route.params.id}/lessons`"><h5><i class="bi bi-house-door"></i> Вернуться к курсу</h5></router-link>
            </div>
          </div>
        </div>

        <div class="dashboard-panel-content row pt-3">
          <div class="col-xl-12">

            <form @submit.prevent="submitHandler">
              <div class="mb-3">
                <label for="questionTitle" class="form-label"><strong>Введите вопрос *</strong></label>
                <input v-model.trim="form.question" class="form-control" id="questionTitle" placeholder="Текст вопроса" :class="{invalid: errors.question}">
                <small v-if="errors.question" class="form-small">{{ errors.question }}</small>
              </div>

              <div class="mb-3">
                <label for="correctAnswer" class="form-label"><strong>Введите правильный ответ *</strong></label>
                <input v-model.trim="form.correct_answer" class="form-control" id="correctAnswer" placeholder="Правильный ответ на вопрос" :class="{invalid: errors.correct_answer}">
                <small v-if="errors.correct_answer" class="form-small">{{ errors.correct_answer }}</small>
              </div>

              <div class="mb-3">
                <label for="incorrectAnswers" class="form-label"><strong>Введите неправильные ответы через запятую *</strong></label>
                <input v-model.trim="form.incorrect_answers" class="form-control" id="incorrectAnswers" placeholder="вариант ответа" :class="{invalid: errors.incorrect_answers}">
                <small v-if="errors.incorrect_answers" class="form-small">{{ errors.incorrect_answers }}</small>
              </div>
          

              <div class="form-buttons">
                <router-link to="/articles/dashboard" class="btn btn-danger me-3">Отменить добавление</router-link>
                <button type="submit" class="btn btn-success"> Добавить вопрос </button>
              </div>
            </form>

          </div>
        </div>

      </div>
    </div>
  </div>

</template>

<script>

export default {
  name: "CourseQuizCreate",
  data() {
    return {
      form: {
        question: "",
        correct_answer: "",
        incorrect_answers: "",
      },
      errors: {
        question: null,
        correct_answer: null,
        incorrect_answers: null,
      }
    }
  },

  methods: {
    formIsValid() {
      let isValid = true


      if (this.form.question.length === 0) {
        this.errors.question = "Вопрос не может быть пустым"
        isValid = false
      } else {
        this.errors.question = null
      }
      if (this.form.correct_answer.length === 0) {
        this.errors.correct_answer = "Введите правильный ответ"
        isValid = false
      } else {
        this.errors.correct_answer = null
      }
      if (this.form.incorrect_answers.length === 0) {
        this.errors.incorrect_answers = "Введите неправильные ответы через запятую ','"
        isValid = false
      } else {
        this.errors.incorrect_answers = null
      }

      return isValid
    },

    submitHandler() {
      if (this.formIsValid()) {

        this.$store.dispatch("questions/addQuestion", {
          form: this.form,
          course_id: this.$route.params.id
        })
      }
    },

  },
  
}
</script>

<style lang="scss">

.form-buttons {
  display: flex;
  justify-content: flex-end;
}

.form-span {
  display: flex;
}

.form-small {
  display: flex;
  color: red;
}

.form-control.invalid {
  border-color: red;
}


</style>>
