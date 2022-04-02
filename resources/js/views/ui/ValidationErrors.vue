<template>

  <div>
    <ul>
      <li>
        <div class="alert alert-danger" role="alert" v-for="(value, index) in validationErrors" :key="index">
          {{ value }}
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

<style>

</style>