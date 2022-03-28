<template>

  <div class="popup">
    <div class="popup__header">
      <span style="color: #ccccc"><h3>Добавление пользователя</h3></span>
        <span class="popup__btn" @click="close">
          <i class="bi bi-x-circle"></i>
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
  methods: {
    close() {
      this.$emit("close")
    }
  }
}
</script>



<style scoped lang="scss">
.popup {
    padding: 16px;
    position: fixed;
    top: 170px;
    left: 590px;
    width: 400px;
    background-color: #82acff;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.5), 0 5px 0 rgba(0, 0, 0, 0.2);

    &__header, &__footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    &__content {
        display: flex;
        justify-content: center;
        align-content: center;
    }

    &__btn {
      padding: 10px 10px;
    }
}
</style>