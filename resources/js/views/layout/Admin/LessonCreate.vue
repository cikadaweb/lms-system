<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">
        <div class="nav">
          <h2>Создать урок для курса: {{ this.$route.params.id }}</h2>
          <router-link :to="'/'"><h5><i class="bi bi-house-door"></i> Вернуться на главную</h5></router-link>
        </div>
        
        <form @submit.prevent="submitHandler">
          <div class="mb-3">
            <label for="lessonTitle" class="form-label"><strong>Название урока *</strong></label>
            <input v-model.trim="form.title" class="form-control" id="lessonTitle" placeholder="Наименование" :class="{invalid: errors.title}">
            <small v-if="errors.title" class="form-small">{{ errors.title }}</small>
          </div>

          <div class="mb-3">
            <label for="lessonBody" class="form-label"><strong>Конспект *</strong></label>
            <textarea id="mytextarea" name="mytextarea" :class="{invalid: errors.body}"></textarea>
            <small v-if="errors.body" class="form-small">{{ errors.body }}</small>
          </div>

          <div class="form-group">
              <label for="feature_file"><strong>Путь к файлу</strong></label>
              <input type="text" class="form-control" id="feature_file" name="feature_file" value="" readonly>


              <button type="button" class="btn btn-primary mt-3 mb-3">
                <a href="" class="popup_selector" style="color: white;" data-inputid="feature_file"><strong>Загрузить конспект</strong></a>
              </button>
              <span class="form-span">Поддерживаемые форматы: pdf/doc</span>
          </div>

          <div class="form-buttons">
            <router-link to="/articles/dashboard" class="btn btn-danger me-3">Отменить создание</router-link>
            <button type="submit" class="btn btn-success"> Создать урок </button>
          </div>
        </form>
      </div>

    </div>
  </div>

</template>

<script>

export default {
  name: "LessonCreate",
  data() {
    return {
      form: {
        title: "",
        body: "",
      },
      errors: {
        title: null,
        body: null,
      }
    }
  },

  methods: {
    formIsValid() {
      let isValid = true

      let filePath = document.getElementById("feature_file")
      this.form.file = filePath.value;

      let textContent = tinymce.get('mytextarea').getContent();
      this.form.body =  textContent ;

      if (this.form.title.length === 0) {
        this.errors.title = "Название урока не может быть пустым"
        isValid = false
      } else {
        this.errors.title = null
      }

      if (this.form.body.length === 0) {
        this.errors.body = "Конспект урока не может быть пустым"
        isValid = false
      } else {
        this.errors.body = null
      }
      return isValid
    },

    submitHandler() {
      if (this.formIsValid()) {

        console.log(this.form)

        this.$store.dispatch("lessons/addLesson", {
          form: this.form,
          course_id: this.$route.params.id
        })
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
