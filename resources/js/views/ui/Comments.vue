<template>
    <div class="row">
        <form @submit.prevent="submit_form()" v-if="!commentSuccess">

            <div class="mb-3">
                <label for="commentBody" class="form-label">Комментарий</label>
                <textarea class="form-control" id="commentBody" rows="3" v-model="body"></textarea>

                <div class="alert alert-warning" role="alert" v-if="errorsMessage.body">
                    {{errorsMessage.body[0]}}
                </div>
            </div>

            <button class="btn btn-success" type="submit">Отправить</button>
            
        </form>

        <div class="alert alert-success" role="alert" v-else>
            Комментарий успешно отправлен!
        </div>

        <div class="toast-container pb-2 mt-5 mx-auto" role="alert" aria-live="assertive" aria-atomic="true" style="min-width: 100%;" v-for="comment in comments" :key="comment.id">
          <div class="toast-block">
            <div class="toast-header">
                <img src="../../../img/user.png" class="rounded me-2 toast-logo" alt="">
                <small class="text-muted">{{comment.created_at}}</small>
            </div>
            <div class="toast-body">
                {{comment.body}}
            </div>
          </div>
        </div>

    </div>
</template>

<script>

export default {
    data() {
        return {
            body: ''
        }
    },
    computed: {
        comments: {
          get() {
            return this.$store.state.articles.currentArticle.comments;
          }
        },
        commentSuccess: {
          get() {
            return this.$store.state.articles.commentSuccess;
          }
        },
        errorsMessage: {
          get() {
            return this.$store.state.articles.errors;
          }
        },
        
    },
    methods: {
        submit_form(){
            this.$store.dispatch('articles/addComment', {
                body: this.body,
                article_id : this.$route.params.id
            })
        }
    },
}
</script>

<style scoped>

.toast-block {
  background-color: rgb(253, 222, 142);
}

.toast-header {
  display: flex;
  justify-content: space-between;
}

.toast-logo {
  width: 20px;
  height: 20px;
}

</style>
