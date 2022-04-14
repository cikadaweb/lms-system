<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="col-12 p-3">

        <div class="nav">
          <h2>Заголовок новости:</h2>
          <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
        </div>

        <img src="" class="border rounded mx-auto d-block" alt="">
        <p>
            <span class="tag">
                <span>label</span>
                <span > | </span>
                <span>extra</span>
                <span>label</span>
                <span > | </span>
                <span>extra</span>
            </span>
        </p>
        <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Maxime a debitis voluptate eum quis quam corporis mollitia voluptates ipsam soluta, sequi totam? Culpa magni illo, reiciendis accusamus molestiae delectus iure consequatur eius. Repudiandae expedita, eius rerum inventore culpa consequuntur quos omnis obcaecati sapiente, quaerat porro perspiciatis ullam facilis, eligendi earum nihil vitae quis quibusdam cupiditate doloremque asperiores? Iusto odio quo itaque numquam reiciendis ut et quidem velit recusandae obcaecati? Veritatis, beatae et sint voluptates dicta neque! Voluptatibus, exercitationem maiores. Adipisci, iusto? Necessitatibus, saepe voluptates iure sit sequi recusandae officia ut maiores a autem ex magnam maxime laboriosam suscipit nulla. Nulla.</p>
        <p>Опубликованно:  <i>1 месяц назад</i></p>
        <div class="mt-3">
            <span class="badge bg-success me-2">45 <i class="bi bi-hand-thumbs-up"></i></span>
            <span class="badge bg-primary me-2">105 <i class="bi bi-eye"></i></span>
        </div>
        
      </div>

    </div>
  </div>



</template>

<script>

export default {
  name: "ArticleShowOne",
  // created() {
  //   this.$store.dispatch("articles/getArticles")
  // },
  computed: {
    getArticles: {
      get() {
        return this.$store.state.articles.articlesList
      }
    },
  }
}
</script>



<style lang="scss">

.custom-container-crud {
    background-color: rgb(255, 255, 255);
    border-radius: 15px;
    padding: 30px;
}

.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.card_news-picture {
  padding: 10px;
  max-height: 300px;
  object-fit: contain;
}

.card_news-text {
    height: 100px;
    text-indent: 5%;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>