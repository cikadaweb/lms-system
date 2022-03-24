<template>

  <div class="popup">
    <div class="popup__header">
      <span style="color: #ccccc"><h2>Settings</h2></span>
      <span>
        <i class="bi bi-x-circle"></i>
      </span>
    </div>
    <div class="popup__content">
      <slot></slot>
    </div>
    <div class="popup__footer pt-2">
      <my-button class="btn-success">Save</my-button>
      <my-button class="btn-danger" @click="close">Close</my-button>
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
    top: 50px;
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
}
</style>