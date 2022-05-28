<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">
        <div class="nav">
          <h2>Создание курса: </h2>
          <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
        </div>
        
        <form @submit.prevent="submitHandler">
          <div class="mb-3">
            <label for="articleTitle" class="form-label"><strong>Название курса *</strong></label>
            <input v-model.trim="form.title" class="form-control" id="articleTitle" placeholder="Наименование" :class="{invalid: errors.title}">
            <small v-if="errors.title" class="form-small">{{ errors.title }}</small>
          </div>

          <div class="mb-3">
            <label for="articlePreview" class="form-label"><strong>Превью курса *</strong></label>
            <input v-model.trim="form.preview" class="form-control" id="articlePreview" placeholder="до 30 символов" :class="{invalid: errors.preview}">
            <small v-if="errors.preview" class="form-small">{{ errors.preview }}</small>
          </div>

          <div class="mb-3">
            <label for="articleDescription" class="form-label"><strong>Описание курса *</strong></label>
            <textarea id="mytextarea" name="mytextarea" :class="{invalid: errors.description}"></textarea>
            <small v-if="errors.description" class="form-small">{{ errors.description }}</small>
          </div>

          <div class="form-group">
              <label for="feature_image"><strong>Изображение курса</strong></label>
              <img src="" alt="" class="img-uploaded" style="display: block; width: 300px">
              <input type="text" class="form-control" id="feature_image" name="feature_image" value="" readonly>

              <button type="button" class="btn btn-primary mt-3 mb-3">
                <a href="" class="popup_selector" style="color: white;" data-inputid="feature_image"><strong>Выберите файл</strong></a>
              </button>
              <span class="form-span">Поддерживаемые форматы: jpg/jpeg/png</span>
          </div>

          <div class="form-buttons">
            <router-link to="/articles/dashboard" class="btn btn-danger me-3">Отменить создание</router-link>
            <button type="submit" class="btn btn-success"> Создать курс </button>
          </div>
        </form>
      </div>

    </div>
  </div>

</template>

<script>

export default {
  name: "CourseCreate",
  data() {
    return {
      form: {
        title: "",
        img: "",
        preview: "",
        description: "",
      },
      errors: {
        title: null,
        preview: null,
        description: null,

      }
    }
  },

  methods: {
    formIsValid() {
      let isValid = true

      let imgPath = document.getElementById("feature_image")
      this.form.img = imgPath.value;
      let textContent = tinymce.get('mytextarea').getContent();
      this.form.description =  textContent ;

      console.log(this.form)

      if (this.form.title.length === 0) {
        this.errors.title = "Название курса не может быть пустым"
        isValid = false
      } else {
        this.errors.title = null
      }

      if (this.form.preview.length === 0) {
        this.errors.preview = "Превью курса не может быть пустым"
        isValid = false
      } else {
        this.errors.preview = null
      }

      if (this.form.description.length === 0) {
        this.errors.description = "Описание курса не может быть пустым"
        isValid = false
      } else {
        this.errors.description = null
      }
      return isValid
    },

    submitHandler() {
      if (this.formIsValid()) {

        this.$store.dispatch("courses/addCourse", this.form)
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
