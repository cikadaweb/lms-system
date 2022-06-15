<template>
  <div class="container">

    <!-- <h1>Тест курса: {{ this.$route.params.id }}</h1> -->

    <h1 v-html="loading ? 'Loading...' : currentQuestion.question" class="text-center pt-5"></h1>
    <!-- Отображается только первый вопрос -->
    <form v-if="currentQuestion" class="pt-5">
      <button
        v-for="answer in currentQuestion.answers"
        :index="currentQuestion.key"
        :key="answer"
        v-html="answer"
        @click.prevent="handleClick"
      ></button>
    </form>

    <div v-if="currentQuestion" class="correctAnswers text-center pt-3">
      Текущий вопрос {{ index + 1 }} из {{ questions.length }}
    </div>

  </div>
</template>

<script>

export default {
  data() {
    return {
      questions: [],
      loading: true,
      index: 0,
    };
  },
  computed: {
    currentQuestion() {
      if (this.questions !== []) {
        return this.questions[this.index];
      }
      return null;
    },

    correctAnswers() {
      if (this.questions && this.questions.length > 0) {
        let streakCounter = 0;
        this.questions.forEach(function (question) {
          if (!question.rightAnswer) {
            return;
          } else if (question.rightAnswer === true) {
            streakCounter++;
          }
        });
        return streakCounter;
      } else {
        return "--";
      }
    },

    quizCompleted() {
      if (this.questions.length === 0) {
        return false;
      }
      // проверка все ли вопросы были заданы 
      let questionsAnswered = 0;
      this.questions.forEach(function (question) {
        question.rightAnswer !== null ? questionsAnswered++ : null;
      });
      return questionsAnswered === this.questions.length;
    },

    score() {
      if (this.questions !== []) {
        return {
          allQuestions: this.questions.length,
          answeredQuestions: this.questions.reduce((count, currentQuestion) => {
            if (currentQuestion.userAnswer) {
              // userAnswer устанавливается, когда пользователь ответил на вопрос, независимо от того, правильный или неправильный
              count++;
            }
            return count;
          }, 0),
          correctlyAnsweredQuestions: this.questions.reduce(
            (count, currentQuestion) => {
              if (currentQuestion.rightAnswer) {
                // rightAnswer верно, если пользователь ответил правильно
                count++;
              }
              return count;
            },
            0
          ),
        };
      } else {
        return {
          allQuestions: 0,
          answeredQuestions: 0,
          correctlyAnsweredQuestions: 0,
        };
      }
    },
  },

  watch: {
    quizCompleted(completed) {
      completed &&
        setTimeout(() => {
          this.$emit("quiz-completed", this.score);
        }, 3000);
    },
  },
  methods: {
    async fetchQuestions() {
      this.loading = true;

      // let response = await fetch("https://fsk-system-default-rtdb.firebaseio.com/results.json");

      let response = await fetch("/api/tests/" + `${this.$route.params.id}`);
      
      // индетификация вопроса
      let index = 0; 
      let data = await response.json();
      // console.log(data);

      let myCategory = data.data.category
      let myQuestions = data.data.questions
      let goodData = []

      for (const question of myQuestions) {
        let info = {}
        info.category = myCategory

        let responseAnswers = await fetch(`/api/questions/${question.id}`);
        let dataAnswers = await responseAnswers.json(); // массив из объектов

        // console.log("Все ответы: ", dataAnswers)

        info.correct_answer = dataAnswers.filter((answer) => {  // узнаем текст правильного ответа
          if (answer.is_correct_answer == 1) {
            return answer
          }
        })[0].answer

        let incorrectAnswers = []
        info.incorrect_answers = dataAnswers.filter((answer) => {
          if (answer.is_correct_answer == 0) {
            return answer
          }
        }).forEach(elem => {
          incorrectAnswers.push(elem.answer)
        })
        info.incorrect_answers = incorrectAnswers
        // console.log(incorrectAnswers)

        info.question = question.question
        info.type = question.type
        goodData.push(info)
        // console.log("Info", info)
      }

      // console.log("Lol", goodData)
      
      let questions = goodData.map((question) => {
        question.answers = [
          question.correct_answer,
          ...question.incorrect_answers,
        ];

        // перетасовка массива с ответами
        for (let i = question.answers.length - 1; i > 0; i--) {
          const j = Math.floor(Math.random() * (i + 1));
          [question.answers[i], question.answers[j]] = [
            question.answers[j],
            question.answers[i],
          ];
        }
        // добавление правильного ответа и ключа
        question.rightAnswer = null;
        question.key = index;
        index++;
        return question;
      });

      this.questions = questions;
      this.loading = false;
    },

    handleClick(e) {
      let index = e.target.getAttribute("index");
      let pollutedUserAnswer = e.target.innerHTML; 
      let userAnswer = pollutedUserAnswer.replace(/'/, "&#039;");
      // установка ответа
      this.questions[index].userAnswer = userAnswer;
      // установка класса "clicked" на нажатую кнопку userAnswer 
      e.target.classList.add("clicked");
      let allButtons = document.querySelectorAll(`[index="${index}"]`);

      for (let i = 0; i < allButtons.length; i++) {
        if (allButtons[i] === e.target) continue;

        allButtons[i].setAttribute("disabled", "");
      }
      this.checkCorrectAnswer(e, index);
    },

    checkCorrectAnswer(e, index) {
      let question = this.questions[index];
      if (question.userAnswer) {
        if (this.index < this.questions.length - 1) {
          setTimeout(
            function () {
              this.index += 1;
            }.bind(this),
            3000
          );
        }
        if (question.userAnswer === question.correct_answer) {
          // Установите класс на кнопку, если пользователь ответил правильно, чтобы отпраздновать правильный ответ с анимацией joyfulButton 
          e.target.classList.add("rightAnswer");
          // Установите rightAnswer на вопрос true, вычисляемое свойство может отслеживать полосу из 20 вопросов 
          this.questions[index].rightAnswer = true;
        } else {
          // Отметьте ответ пользователя как неправильный ответ 
          e.target.classList.add("wrongAnswer");
          this.questions[index].rightAnswer = false;
          // Показать правильный ответ 
          let correctAnswer = this.questions[index].correct_answer;
          let allButtons = document.querySelectorAll(`[index="${index}"]`);
          allButtons.forEach(function (button) {
            if (button.innerHTML === correctAnswer) {
              button.classList.add("showRightAnswer");
            }
          });
        }
      }
    },
  },
  mounted() {
    this.fetchQuestions();
  },
};
</script>

<style scoped>
.container {
  margin: 1rem auto;
  padding: 1rem;
  max-width: 750px;
}
form {
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;
  justify-content: center;
}
button {
  font-size: 1.1rem;
  box-sizing: border-box;
  padding: 1rem;
  margin: 0.5rem;
  width: 40%;
  background-color: rgba(100, 100, 100, 0.3);
  border: none;
  border-radius: 0.4rem;
  box-shadow: 3px 5px 5px rgba(0, 0, 0, 0.2);
}
button:hover:enabled {
  transform: scale(1.02);
  box-shadow: 0 3px 3px 0 rgba(0, 0, 0, 0.14), 0 1px 7px 0 rgba(0, 0, 0, 0.12),
    0 3px 1px -1px rgba(0, 0, 0, 0.2);
  cursor: pointer;
}
button:focus {
  outline: none;
}
button:active:enabled {
  transform: scale(1.05);
}

@keyframes flashButton {
  0% {
    opacity: 1;
    transform: scale(1.01);
  }
  50% {
    opacity: 0.7;
    transform: scale(1.02);
  }
  100% {
    opacity: 1;
    transform: scale(1);
  }
}

button.clicked {
  pointer-events: none;
}

button.rightAnswer {
  animation: flashButton;
  animation-duration: 700ms;
  animation-delay: 200ms;
  animation-iteration-count: 3;
  animation-timing-function: ease-in-out;
  color: black;
  background: linear-gradient(
    210deg,
    rgba(0, 178, 72, 0.25),
    rgba(0, 178, 72, 0.5)
  );
}

button.wrongAnswer {
  color: black;
  background: linear-gradient(
    210deg,
    rgba(245, 0, 87, 0.25),
    rgba(245, 0, 87, 0.5)
  );
}

button.showRightAnswer {
  animation: flashButton;
  animation-duration: 700ms;
  animation-delay: 200ms;
  animation-iteration-count: 2;
  animation-timing-function: ease-in-out;
  color: black;
  background: linear-gradient(
    210deg,
    rgba(0, 178, 72, 0.25),
    rgba(0, 178, 72, 0.5)
  );
}
</style>
