<template>

  <div class="container custom-container-crud">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">
        <div class="nav">
          <h2>Изменение данных статьи: </h2>
          <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
        </div>
        
        <form @submit.prevent="submitHandler">
          <div class="mb-3">
            <label for="articleTitle" class="form-label"><strong>Название статьи *</strong></label>
            <input v-model.trim="article.title" class="form-control" id="articleTitle" placeholder="Наименование" :class="{invalid: errors.title}">
            <small v-if="errors.title" class="form-small">{{ errors.title }}</small>
          </div>

          <div class="mb-3">
            <label for="articlePreview" class="form-label"><strong>Превью статьи *</strong></label>
            <input v-model.trim="article.preview" class="form-control" id="articlePreview" placeholder="до 30 символов" :class="{invalid: errors.preview}">
            <small v-if="errors.preview" class="form-small">{{ errors.preview }}</small>
          </div>

          <div class="mb-3">
            <label for="articleDescription" class="form-label"><strong>Текст статьи *</strong></label>
            <textarea id="mytextarea" name="mytextarea" v-model.trim="article.body" :class="{invalid: errors.body}"></textarea>
            <small v-if="errors.body" class="form-small">{{ errors.body }}</small>
          </div>

          <div class="form-group">
              <label for="feature_image"><strong>Изображение статьи *</strong></label>
              <img src="" alt="" class="img-uploaded" style="display: block; width: 300px">
              <input v-model.trim="article.img" type="text" class="form-control" id="feature_image" name="feature_image" :class="{invalid: errors.img}">

              <small v-if="errors.img" class="form-small">{{ errors.img }}</small>

              <button class="btn btn-primary mt-3 mb-3" type="btn">
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

export default {
  name: "ArticleEdit",
  data() {
    return {
      errors: {
        title: null,
        preview: null,
        body: null,
        img: null
      }
    }
  },
  created() {
     this.$store.dispatch("articles/getArticleData", this.$route.params.id)
  },

  computed: {
    article: {
      get() {
        return this.$store.state.articles.currentArticle
      }
    },
  },

  methods: {
    formIsValid() {
      let isValid = true

      if (this.article.title.length === 0) {
        this.errors.title = "Название статьи не может быть пустым"
        isValid = false
      } else {
        this.errors.title = null
      }

      if (this.article.preview.length === 0) {
        this.errors.preview = "Превью не может быть пустым"
        isValid = false
      } else {
        this.errors.preview = null
      }

      if (this.article.body.length === 0) {
        this.errors.body = "Текст статьи не может быть пустым"
        isValid = false
      } else {
        this.errors.body = null
      }

      if (this.article.img.length === 0) {
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
        this.article.img = imgPath.value;

        let textContent = tinymce.get('mytextarea').getContent();
        this.article.body =  textContent ;

        this.$store.dispatch("articles/changeArticle", this.article, this.$route.params.id)
      }
    },

  },

  mounted() {
    tinymce.remove();
    tinymce.init({
    selector: '#mytextarea',
    height: 500,
    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    language: 'ru',
    toolbar_mode: 'floating',
    relative_urls: false,
    file_picker_callback: elFinderBrowser
  });

  function elFinderBrowser(callback, value, meta) {
    tinymce.activeEditor.windowManager.openUrl({
      title: 'File Manager',
      url: "/elfinder/tinymce5",
      /**
       * On message will be triggered by the child window
       * 
       * @param dialogApi
       * @param details
       * @see https://www.tiny.cloud/docs/ui-components/urldialog/#configurationoptions
       */
      onMessage: function(dialogApi, details) {
        if (details.mceAction === 'fileSelected') {
          const file = details.data.file;

          // Make file info
          const info = file.name;

          // Provide file and text for the link dialog
          if (meta.filetype === 'file') {
            callback(file.url, {
              text: info,
              title: info
            });
          }

          // Provide image and alt text for the image dialog
          if (meta.filetype === 'image') {
            callback(file.url, {
              alt: info
            });
          }

          // Provide alternative source and posted for the media dialog
          if (meta.filetype === 'media') {
            callback(file.url);
          }

          dialogApi.close();
        }
      }
    });
  }
  }
  
}
</script>

<style lang="scss">



</style>>
