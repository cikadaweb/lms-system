<template>
    <span @click="addLike()" class="badge rounded-pill article_badge me-2 likesButton" :class="isLike ? 'bg-success': 'bg-danger'">
        {{ likes }} <i class="bi bi-hand-thumbs-up"></i>
    </span>
</template>

<script>

export default {
    computed: {
        isLike(){
            return this.$store.state.articles.likeIt;
        },
        likes: {
            get() {
                return this.$store.getters['articles/articleLikes']
            }
        },
    },
    methods: {
        addLike(){
            this.$store.dispatch('articles/addLike', {
                id : this.$route.params.id,
                increment: this.isLike
            })
        }
    },
}
</script>

<style scoped>

.likesButton {
    cursor: pointer;
}

</style>
