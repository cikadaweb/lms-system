<template>

  <div class="popup">
    <div class="popup__header d-flex justify-content-between align-items-center">
      <h3>{{ title }}</h3>
      <span class="popup__btn" @click="close">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
          <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z"/>
        </svg>
      </span>
    </div>
    <div class="popup__content">
      <slot></slot>
    </div>
  </div>

</template>



<script>

export default {
  name: "my-window",
  props: ["title"],
  methods: {
    close() {
      this.$emit("close")
    }
  }
}
</script>



<style scoped lang="scss">

.popup {
    padding: 50px;
    position: fixed;
    z-index: 1;
    top: 20px;
    left: 449px;
    width: 671px;
    background-color: #82acff;
    border-radius: 15px;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.5), 0 5px 0 rgba(0, 0, 0, 0.2);
}

.popup__btn {
  padding: 10px;
}

.popup__btn:hover {
  color: red;
}
</style>