<template>

  <div>
    <ul>
      <li>
        <div class="alert alert-danger alert-block" role="alert" v-for="(value, index) in validationErrors" :key="index">
          <div class="alert__text">
            {{ value }}
          </div>
          <div class="alert__btn" onclick="this.parentElement.style.display='none';">
            <i class="bi bi-x-circle"></i>
          </div>
        </div>
      </li>
    </ul>
  </div>

</template>

<script>
export default {
  name: "validation-errors",
  props: ["errors"],
  computed: {
    validationErrors() {
      let errors = Object.values(this.errors)
      errors = errors.flat()
      return errors
    }
  }

}
</script>

<style lang="scss" scoped>

.alert-block {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

</style>>


