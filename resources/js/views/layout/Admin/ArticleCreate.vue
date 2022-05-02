<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">
        <div class="nav">
          <h2>Создать статью: </h2>
          <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
        </div>
        
        <form @submit.prevent="submitHandler">
          <div class="mb-3">
            <label for="articleTitle" class="form-label"><strong>Название статьи *</strong></label>
            <input v-model.trim="form.title" class="form-control" id="articleTitle" placeholder="Наименование" :class="{invalid: errors.title}">
            <small v-if="errors.title" class="form-small">{{ errors.title }}</small>
          </div>

          <div class="mb-3">
            <label for="articlePreview" class="form-label"><strong>Превью статьи *</strong></label>
            <input v-model.trim="form.preview" class="form-control" id="articlePreview" placeholder="до 30 символов" :class="{invalid: errors.preview}">
            <small v-if="errors.preview" class="form-small">{{ errors.preview }}</small>
          </div>

          <div class="mb-3">
            <label for="articleDescription" class="form-label"><strong>Текст статьи *</strong></label>
            <textarea id="mytextarea" name="mytextarea" :class="{invalid: errors.body}"></textarea>
            <small v-if="errors.body" class="form-small">{{ errors.body }}</small>
          </div>

          <div class="form-group">
              <label for="feature_image"><strong>Изображение статьи *</strong></label>
              <img src="" alt="" class="img-uploaded" style="display: block; width: 300px">
              <input type="text" class="form-control" id="feature_image" name="feature_image" value="" readonly :class="{invalid: errors.img}">

              <small v-if="errors.img" class="form-small">{{ errors.img }}</small>

              <button type="button" class="btn btn-primary mt-3 mb-3">
                <a href="" class="popup_selector" style="color: white;" data-inputid="feature_image"><strong>Выберите файл</strong></a>
              </button>
              <span class="form-span">Поддерживаемые форматы: jpg/jpeg/png</span>
          </div>

          <div class="form-buttons">
            <router-link to="/articles/dashboard" class="btn btn-danger me-3">Отменить создание</router-link>
            <button type="submit" class="btn btn-success"> Создать статью </button>
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
        preview: "",
        body: "",
        img: ""
      },
      errors: {
        title: null,
        preview: null,
        body: null,
        img: null
      }
    }
  },

  methods: {
    formIsValid() {
      let isValid = true

      if (this.form.title.length === 0) {
        this.errors.title = "Название статьи не может быть пустым"
        isValid = false
      } else {
        this.errors.title = null
      }

      if (this.form.preview.length === 0) {
        this.errors.preview = "Превью не может быть пустым"
        isValid = false
      } else {
        this.errors.preview = null
      }

      if (this.form.body.length === 0) {
        this.errors.body = "Текст статьи не может быть пустым"
        isValid = false
      } else {
        this.errors.body = null
      }

      if (this.form.img.length === 0) {
        this.errors.img = "Необходимо выбрать изображение статьи"
        isValid = false
      } else {
        this.errors.img = null
      }
      return isValid
    },

    submitHandler() {
      if (this.formIsValid()) {
        let imgPath = document.getElementById("feature_image")
        this.form.img = imgPath.value;

        let textContent = tinymce.get('mytextarea').getContent();
        this.form.body =  textContent ;

        this.$store.dispatch("articles/addArticle", this.form)
      }
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

.form-small {
  display: flex;
  color: red;
}

.form-control.invalid {
  border-color: red;
}


</style>>
