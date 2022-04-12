<template>

  <div class="container custom-container mt-3">
    <div class="row pt-3 pb-3">

      <h2>Создать статью о фильме:</h2>
      
      <form @submit.prevent="submitHandler">

        <div class="mb-3">
          <label for="movieTitle" class="form-label">Название статьи</label>
          <input v-model.trim="form.title" class="form-control" id="movieTitle" placeholder="Наименование">
        </div>


        <!-- <div class="mb-3">
          <label for="movieDescription" class="form-label">Описание фильма *</label>
          <textarea v-model.trim="form.description"class="form-control" id="movieDescription" rows="3" rows="3"></textarea>
        </div> -->

        <div class="mb-3">
          <label for="movieDescription" class="form-label">Описание фильма *</label>
          <textarea id="mytextarea" name="mytextarea" rows="5"></textarea>
        </div>

        <div class="form-group">
            <label for="feature_image">* Изображение статьи</label>
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
      
      // this.createMovie()
    },

    addNews() {
      this.$store.dispatch("users/addUser", this.user)
    },

    async createMovie() {
      try {
        console.log(this.form)
        axios.post("http://127.0.0.1:8000/api/movies", this.form, {
          headers: {
            "Content-type": "application/json"
          }
        })

        .then(res => {
          if (res.data.status) {
            this.$router.push("/movies")
          }
        })

      } catch (e) {
          console.log(e.message);
      }
    }
  },
  
}
</script>

<style lang="scss" scoped>

.custom-container {
    background-color: rgb(255, 255, 255);
    border-radius: 15px;
}

</style>>
