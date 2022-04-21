<template>
    <span class="badge rounded-pill bg-primary article_badge me-2">{{ views }} <i class="bi bi-eye"></i></span>
</template>

<script>
export default {
    computed: {
        views: {
          get() {
            return this.$store.getters['articles/articleViews']
          }
        },
        
    },
    // mounted() {
    //     console.log('Views mounted.')
    // }
}
</script>

<style scoped>



</style>