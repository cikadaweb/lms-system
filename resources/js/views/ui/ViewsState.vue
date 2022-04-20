<template>
    <span class="badge bg-danger">{{ viewsNumber }} <i class="bi bi-eye"></i></span>
</template>

<script>
export default {
    computed: {
        viewsNumber: {
          get() {
            return this.$store.getters['articles/articleViews']
          }
        },
        
    },
}
</script>

<style scoped>



</style>