<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header d-flex justify-content-center">
            <h2>{{ header }}</h2>
          </div>

          <div class="modal-body">
            <div id="score">
              Вы ответили на
              <span class="highlight">
                {{
                  Math.floor(
                    (score.correctlyAnsweredQuestions / score.allQuestions) *
                      100
                  )
                }}
                % правильно!
              </span>
              Отвечено на
              <span class="highlight">
                {{ score.correctlyAnsweredQuestions }} из
                {{ score.allQuestions }}
              </span>
              вопросов.
            </div>
          </div>

          <div class="modal-footer">
            <button
              class="btn btn-success button-footer"
              @click="$emit('reload')"
            >
              Пройти еще раз
            </button>
            <button
              class="btn btn-danger button-footer"
              @click="$emit('close')"
            >
              Закрыть
            </button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  props: {
    header: String,
    score: Object,
  },
};
</script>

<style scoped>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 90vw;
  max-width: 650px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 6px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
}

.modal-body {
  display: flex;
  flex-direction: column;
  margin: 20px 0;
  line-height: 3rem;
}

.modal-body > * {
  margin: 1rem 0;
  padding: 0.25rem 0.5rem;
}

.modal-footer {
  display: flex;
  justify-content: space-between;
}

/*
 Modal Transition
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}

.button-footer {
  padding: 1rem 2rem;
  /* color: white;
  background: linear-gradient(
    210deg,
    rgba(187, 0, 47, 0.8),
    rgba(245, 0, 87, 0.6)
  );
  border-radius: 7px;
  border: none; */
}

.anchor-footer {
  color: black;
  text-decoration: none;
  cursor: default;
}

.button-footer:active,
.button-footer:focus {
  outline: none;
}

.button-footer:hover {
  transform: scale(1.02);
}

/* #play-again {
  background-color: rgb(2, 183, 2);
}

#close-button {
  background-color: rgb(238, 50, 50);
} */

.highlight {
  border-radius: 4px;
  background-color: rgba(187, 0, 47, 0.3);
  padding: 0.25rem 0.5rem;
}

#score {
  background-color: rgb(210, 200, 200);
  border-radius: 5px;
  box-shadow: 2px 3px 9px gray;
}

#chooseCategory {
  text-align: center;
}
</style>