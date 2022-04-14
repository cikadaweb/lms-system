<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <h2>Создать статью:</h2>
      
      <form @submit.prevent="submitHandler">

        <div class="mb-3">
          <label for="movieTitle" class="form-label">Название статьи *</label>
          <input v-model.trim="form.title" class="form-control" id="movieTitle" placeholder="Наименование">
        </div>

        <div class="mb-3">
          <label for="movieDescription" class="form-label">Описание статьи *</label>
          <textarea id="mytextarea" name="mytextarea"></textarea>
        </div>

        <div class="form-group">
            <label for="feature_image">Изображение статьи *</label>
            <img src="" alt="" class="img-uploaded" style="display: block; width: 300px">
            <input type="text" class="form-control" id="feature_image" name="feature_image" value="" readonly>
            <button class="btn btn-success mt-3 mb-3">
              <a href="" class="popup_selector" style="color: white;" data-inputid="feature_image">Выбрать изображение</a>
            </button> 
        </div>

        <button type="submit" class="btn btn-primary">Создать статью</button>
      </form>

    </div>
  </div>

</template>

<script>
import axios from "../../../../axios/axios-instance";

export default {
  name: "ArticleCreate",
  data() {
    return {
      form: {
        title: "",
        img: "",
        body: "",
      }
    }
  },

  methods: {
    formIsValid() {
      let isValid = true

      if (this.form.title.length === 0) {
        isValid = false
      }

      return isValid
    },

    submitHandler() {
      // if (this.formIsValid()) {

      // }

      let imgPath = document.getElementById("feature_image")
      this.form.img = imgPath.value;

      let textContent = tinymce.get('mytextarea').getContent();
      this.form.body =  textContent ;


      console.log(this.form)
      
      this.$store.dispatch("articles/addArticle", this.form)
    },

  },
  
}
</script>

<style lang="scss">

.custom-container-crud {
    background-color: rgb(255, 255, 255);
    border-radius: 15px;
}

</style>>
