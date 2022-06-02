<template>

  <div class="container custom-container-crud">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">
        <div class="nav">
          <h2>Изменение данных урока: </h2>
          <router-link :to="`/course-id${this.$route.params.id}/lessons`"><h5><i class="bi bi-arrow-left-circle"></i> Вернуться к курсу</h5></router-link>
        </div>
        
        <form @submit.prevent="submitHandler">
          <div class="mb-3">
            <label for="lessonTitle" class="form-label"><strong>Название урока *</strong></label>
            <input v-model.trim="lesson.title" class="form-control" id="lessonTitle" placeholder="Наименование" :class="{invalid: errors.title}">
            <small v-if="errors.title" class="form-small">{{ errors.title }}</small>
          </div>

          <div class="mb-3">
            <label for="lessonBody" class="form-label"><strong>Лекция *</strong></label>
            <textarea id="mytextarea" name="mytextarea" v-model.trim="lesson.body" :class="{invalid: errors.body}"></textarea>
            <small v-if="errors.body" class="form-small">{{ errors.body }}</small>
          </div>

          <div class="form-group">
              <label for="feature_image"><strong>Файл конспекта *</strong></label>
              <img src="" alt="" class="img-uploaded" style="display: block; width: 300px">
              <input v-model.trim="lesson.lesson_file" type="text" class="form-control" id="feature_image" name="feature_image" :class="{invalid: errors.lesson_file}">

              <small v-if="errors.lesson_file" class="form-small">{{ errors.lesson_file }}</small>

              <button class="btn btn-primary mt-3 mb-3" type="btn">
                <a href="" class="popup_selector" style="color: white;" data-inputid="feature_image"><strong>Выберите файл</strong></a>
              </button>
              <span class="form-span">Поддерживаемые форматы: jpg/jpeg/png</span>
          </div>

          <div class="form-buttons">
            <router-link :to="`/course-id${this.$route.params.id}/lessons`" class="btn btn-danger me-3">Отменить изменение</router-link>
            <button type="submit" class="btn btn-success" @click.prevent="submitHandler"> Изменить урок </button>
          </div>
        </form>
      </div>

    </div>
  </div>

</template>

<script>

export default {
  name: "LessonEdit",
  data() {
    return {
      errors: {
        title: null,
        lesson_file: null,
        body: null,
      }
    }
  },
  created() {
    this.$store.dispatch("lessons/getLessonData", this.$route.params.lesson)
  },

  computed: {
    lesson: {
      get() {
        return this.$store.state.lessons.currentLesson
      }
    },
  },

  methods: {
    formIsValid() {
          let isValid = true

          let filePath = document.getElementById("feature_image")
          this.lesson.lesson_file = filePath.value;

          let textContent = tinymce.get('mytextarea').getContent();
          this.lesson.body =  textContent ;

          if (this.lesson.title.length === 0) {
            this.errors.title = "Название урока не может быть пустым"
            isValid = false
          } else {
            this.errors.title = null
          }

          if (this.lesson.body.length === 0) {
            this.errors.body = "Конспект урока не может быть пустым"
            isValid = false
          } else {
            this.errors.body = null
          }
          return isValid
        },

    submitHandler() {
      if (this.formIsValid()) {
        let filePath = document.getElementById("feature_image")
        this.lesson.lesson_file = filePath.value;

        let textContent = tinymce.get('mytextarea').getContent();
        this.lesson.body =  textContent ;

        // console.log("Изменение инфы о курсе:", this.lesson)

        this.$store.dispatch("lessons/changeLesson", {
          lesson: this.lesson,
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



</style>>
