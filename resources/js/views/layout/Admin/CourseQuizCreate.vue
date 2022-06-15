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
                <input v-model.trim="form.correct_answer" class="form-control" id="correctAnswer" placeholder="Правильный вариант ответа" :class="{invalid: errors.correct_answer}">
                <small v-if="errors.correct_answer" class="form-small">{{ errors.correct_answer }}</small>
              </div>

              <div class="mb-3">
                <label for="incorrectAnswer1" class="form-label"><strong>Введите неправильный ответ *</strong></label>
                <input v-model.trim="incorrect_answer_1" class="form-control" id="incorrectAnswer1" placeholder="вариант ответа" :class="{invalid: errors.incorrect_answer_1}">
                <small v-if="errors.incorrect_answer_1" class="form-small">{{ errors.incorrect_answer_1 }}</small>
              </div>

              <div class="mb-3">
                <label for="incorrectAnswer2" class="form-label"><strong>Введите неправильный ответ *</strong></label>
                <input v-model.trim="incorrect_answer_2" class="form-control" id="incorrectAnswer2" placeholder="вариант ответа" :class="{invalid: errors.incorrect_answer_2}">
                <small v-if="errors.incorrect_answer_2" class="form-small">{{ errors.incorrect_answer_2 }}</small>
              </div>

              <div class="mb-3">
                <label for="incorrectAnswer3" class="form-label"><strong>Введите неправильный ответ *</strong></label>
                <input v-model.trim="incorrect_answer_3" class="form-control" id="incorrectAnswer3" placeholder="вариант ответа" :class="{invalid: errors.incorrect_answer_3}">
                <small v-if="errors.incorrect_answer_3" class="form-small">{{ errors.incorrect_answer_3 }}</small>
              </div>

              <div class="div">
                <button class="btn btn-outline-success">Добавить вариант ответа  
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                  </svg>
                </button>
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
      incorrect_answer_1: "",
      incorrect_answer_2: "",
      incorrect_answer_3: "",
      errors: {
        question: null,
        correct_answer: null,
        incorrect_answer_1: null,
        incorrect_answer_2: null,
        incorrect_answer_3: null,
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
      if (this.incorrect_answer_1.length === 0) {
        this.errors.incorrect_answer_1 = "Введите неправильный ответ"
        isValid = false
      } else {
        this.errors.incorrect_answer_1 = null
      }
      if (this.incorrect_answer_2.length === 0) {
        this.errors.incorrect_answer_2 = "Введите неправильный ответ"
        isValid = false
      } else {
        this.errors.incorrect_answer_2 = null
      }
      if (this.incorrect_answer_3.length === 0) {
        this.errors.incorrect_answer_3 = "Введите неправильный ответ"
        isValid = false
      } else {
        this.errors.incorrect_answer_3 = null
      }
     

      return isValid
    },

    submitHandler() {
      if (this.formIsValid()) {

        this.form.incorrect_answers = this.incorrect_answer_1 + "," + this.incorrect_answer_2 + "," + this.incorrect_answer_3
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
