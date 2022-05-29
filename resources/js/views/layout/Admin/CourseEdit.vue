<template>

  <div class="container custom-container-crud">
    <div class="row pt-3 pb-3">

      <div class="col-xl-12">
        <div class="nav">
          <h2>Изменение данных курса: </h2>
            <router-link :to="`/course-id${this.$route.params.id}/lessons`"><h5><i class="bi bi-arrow-left-circle"></i> Вернуться к курсу</h5></router-link>
        </div>
        
        <form @submit.prevent="submitHandler">
          <div class="mb-3">
            <label for="courseTitle" class="form-label"><strong>Название курса *</strong></label>
            <input v-model.trim="course.title" class="form-control" id="courseTitle" placeholder="Наименование" :class="{invalid: errors.title}">
            <small v-if="errors.title" class="form-small">{{ errors.title }}</small>
          </div>

          <div class="mb-3">
            <label for="coursePreview" class="form-label"><strong>Превью курса *</strong></label>
            <input v-model.trim="course.preview" class="form-control" id="coursePreview" placeholder="до 30 символов" :class="{invalid: errors.preview}">
            <small v-if="errors.preview" class="form-small">{{ errors.preview }}</small>
          </div>

          <div class="mb-3">
            <label for="courseDescription" class="form-label"><strong>Текст статьи *</strong></label>
            <textarea id="mytextarea" name="mytextarea" v-model.trim="course.description" :class="{invalid: errors.body}"></textarea>
            <small v-if="errors.description" class="form-small">{{ errors.description }}</small>
          </div>

          <div class="form-group">
              <label for="feature_image"><strong>Изображение статьи *</strong></label>
              <img src="" alt="" class="img-uploaded" style="display: block; width: 300px">
              <input v-model.trim="course.img" type="text" class="form-control" id="feature_image" name="feature_image" :class="{invalid: errors.img}">

              <small v-if="errors.img" class="form-small">{{ errors.img }}</small>

              <button class="btn btn-primary mt-3 mb-3" type="btn">
                <a href="" class="popup_selector" style="color: white;" data-inputid="feature_image"><strong>Выберите файл</strong></a>
              </button>
              <span class="form-span">Поддерживаемые форматы: jpg/jpeg/png</span>
          </div>

          <div class="form-buttons">
            <router-link to="/courses/dashboard" class="btn btn-danger me-3">Отменить изменение</router-link>
            <button type="submit" class="btn btn-success" @click.prevent="submitHandler"> Изменить курс </button>
          </div>
        </form>
      </div>

    </div>
  </div>

</template>

<script>

export default {
  name: "CourseEdit",
  data() {
    return {
      errors: {
        title: null,
        preview: null,
        description: null,
        img: null
      }
    }
  },
  created() {
    this.$store.dispatch("courses/getCourseData", this.$route.params.id)
  },

  computed: {
    course: {
      get() {
        return this.$store.state.courses.currentCourse
      }
    },
  },

  methods: {
    formIsValid() {
          let isValid = true

          let imgPath = document.getElementById("feature_image")
          this.course.img = imgPath.value;
          let textContent = tinymce.get('mytextarea').getContent();
          this.course.description =  textContent ;

          if (this.course.title.length === 0) {
            this.errors.title = "Название курса не может быть пустым"
            isValid = false
          } else {
            this.errors.title = null
          }

          if (this.course.preview.length === 0) {
            this.errors.preview = "Превью курса не может быть пустым"
            isValid = false
          } else {
            this.errors.preview = null
          }

          if (this.course.description.length === 0) {
            this.errors.description = "Описание курса не может быть пустым"
            isValid = false
          } else {
            this.errors.description = null
          }
          return isValid
        },

    submitHandler() {
      if (this.formIsValid()) {
        let imgPath = document.getElementById("feature_image")
        this.course.img = imgPath.value;

        let textContent = tinymce.get('mytextarea').getContent();
        this.course.body =  textContent ;

        // console.log(this.course)

        this.$store.dispatch("courses/changeCourse", this.course, this.$route.params.id)
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
