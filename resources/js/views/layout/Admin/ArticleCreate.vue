<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">
        <div class="nav">
          <h2>Создать статью: </h2>
          <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
        </div>
        
        <form>
          <div class="mb-3">
            <label for="articleTitle" class="form-label"><strong>Название статьи *</strong></label>
            <input v-model.trim="form.title" class="form-control" id="articleTitle" placeholder="Наименование">
          </div>

          <div class="mb-3">
            <label for="articlePreview" class="form-label"><strong>Превью статьи *</strong></label>
            <input v-model.trim="form.preview" class="form-control" id="articlePreview" placeholder="до 30 символов">
          </div>

          <div class="mb-3">
            <label for="articleDescription" class="form-label"><strong>Текст статьи *</strong></label>
            <textarea id="mytextarea" name="mytextarea"></textarea>
          </div>

          <div class="form-group">
              <label for="feature_image"><strong>Изображение статьи *</strong></label>
              <img src="" alt="" class="img-uploaded" style="display: block; width: 300px">
              <input type="text" class="form-control" id="feature_image" name="feature_image" value="" readonly>
              <button class="btn btn-primary mt-3 mb-3">
                <a href="" class="popup_selector" style="color: white;" data-inputid="feature_image"><strong>Выберите файл</strong></a>
              </button>
              <span class="form-span">Поддерживаемые форматы: jpg/jpeg/png</span>
          </div>

          <div class="form-buttons">
            <router-link to="/articles/dashboard" class="btn btn-danger me-3">Отменить создание</router-link>
            <button type="submit" class="btn btn-success" @click.prevent="submitHandler"> Создать статью </button>
          </div>
        </form>
      </div>

    </div>
  </div>

</template>

<script>

export default {
  name: "ArticleCreate",
  data() {
    return {
      form: {
        title: "",
        img: "",
        preview: "",
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
      // if (this.formIsValid()) {}

      let imgPath = document.getElementById("feature_image")
      this.form.img = imgPath.value;

      let textContent = tinymce.get('mytextarea').getContent();
      this.form.body =  textContent ;

      this.$store.dispatch("articles/addArticle", this.form)
      this.$router.push("/articles/dashboard");
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
