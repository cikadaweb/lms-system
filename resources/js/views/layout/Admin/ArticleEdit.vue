<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">
        <div class="nav">
          <h2>Изменение данных статьи: </h2>
          <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
        </div>
        
        <form>
          <div class="mb-3">
            <label for="articleTitle" class="form-label"><strong>Название статьи *</strong></label>
            <input v-model.trim="article.title" class="form-control" id="articleTitle" placeholder="Наименование">
          </div>

          <div class="mb-3">
            <label for="articlePreview" class="form-label"><strong>Превью статьи *</strong></label>
            <input v-model.trim="article.preview" class="form-control" id="articlePreview" placeholder="до 30 символов">
          </div>

          <div class="mb-3">
            <label for="articleDescription" class="form-label"><strong>Текст статьи *</strong></label>
            <textarea id="mytextarea" name="mytextarea" v-model.trim="article.body"></textarea>
          </div>

          <div class="form-group">
              <label for="feature_image"><strong>Изображение статьи *</strong></label>
              <img src="" alt="" class="img-uploaded" style="display: block; width: 300px">
              <input v-model.trim="article.img" type="text" class="form-control" id="feature_image" name="feature_image" readonly>
              <button class="btn btn-primary mt-3 mb-3">
                <a href="" class="popup_selector" style="color: white;" data-inputid="feature_image"><strong>Выберите файл</strong></a>
              </button>
              <span class="form-span">Поддерживаемые форматы: jpg/jpeg/png</span>
          </div>

          <div class="form-buttons">
            <router-link to="/articles/dashboard" class="btn btn-danger me-3">Отменить изменение</router-link>
            <button type="submit" class="btn btn-success" @click.prevent="submitHandler"> Изменить статью </button>
          </div>
        </form>
      </div>

    </div>
  </div>

</template>

<script>
import axios from "../../../../axios/axios-instance";

export default {
  name: "ArticleEdit",
  data() {
    return {
      article: {
        title: "",
        preview: "",
        body: "",
        img: ""

      }
    }
  },
  mounted() {
    //  this.$store.dispatch("articles/getArticleData", this.$route.params.id)
  },

  computed: {
    // article: {
    //   get() {
    //     return this.$store.state.articles.currentArticle
    //   }
    // },
  },

  methods: {
    formIsValid() {
      let isValid = true

      if (this.article.title.length === 0) {
        isValid = false
      }

      return isValid
    },

    submitHandler() {
      // if (this.formIsValid()) {}

      let imgPath = document.getElementById("feature_image")
      this.article.img = imgPath.value;

      let textContent = tinymce.get('mytextarea').getContent();
      this.article.body =  textContent ;

      axios.put("/api/articles/" + this.$route.params.id, {
              title: this.article.title,
              img: this.article.img,
              body: this.article.body,
          }).then((response) => {
            this.$router.push({name: "ArticlesDasboard"});
          });
    },

  },
  
}
</script>

<style lang="scss">

.custom-container-crud {
    background-color: rgb(255, 255, 255);
    border-radius: 15px;
    padding: 50px;
}

.form-buttons {
  display: flex;
  justify-content: flex-end;
}

.form-span {
  display: flex;
}


</style>>
