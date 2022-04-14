<template>

  <div class="container">
    <div class="row justify-content-md-center">

        <div class="alert alert-danger alert-block" role="alert"
        v-if="invalidCredentials"
        :style="{
          display: invalidCredentials ? 'flex' : 'none'
        }"  
        >
          <div class="alert__text">
            Неверно введенные данные!
          </div>
          <div class="alert__btn" onclick="this.parentElement.style.display='none';">
            <i class="bi bi-x-circle"></i>
          </div>
        </div>

        <validation-errors v-if="validationErrors" :errors="validationErrors"></validation-errors>

        <div class="register-page">
          
          <form class="form">
            <h2>Регистрация</h2>
            <my-input type="text" placeholder="username" v-model="user.name" required=true></my-input>
            <my-input type="email" placeholder="email address" v-model="user.email"></my-input>
            <my-input type="password" placeholder="password" v-model="user.password"></my-input>
            <my-input type="password" placeholder="password confirmation" v-model="user.password_confirmation"></my-input>
            <my-button type="submit" class="btn-success" @click.prevent="register">Создать аккаунт <i class="bi bi-person-plus"></i></my-button>
            <router-link to="/user/login"><p class="message">Уже зарегистрированы?</p><a href="#">Войти</a></router-link>
          </form>
          
        </div>
    </div>
  </div>

</template>



<script>
import { mapGetters } from "vuex"
import ValidationErrors from "../ui/ValidationErrors.vue";

export default {
  name: "Registration",
  data() {
    return {
      user: {
        name: "",
        email:"",
        password: "",
        password_confirmation: ""
      },
      isShowAlert: false
    }
  },
  methods: {
    register() {
      this.$store.dispatch("auth/registerUser", this.user)
    }
  },
    computed: {
    ...mapGetters({
      invalidCredentials: "auth/invalidCredentials",
      validationErrors: "auth/errors"
    })  
  },
  components: {ValidationErrors}
}
</script>



<style scoped lang="scss">

.alert-block {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.register-page {
    width: 550px;
    padding: 8% 0 0;
    margin: auto;
    display:flex;
}

.form {
    position: relative;
    // z-index: 1;
    background-size: cover;
    background-position: center; 
    max-width: 550px;
    border-radius: 15px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.5), 0 5px 0 rgba(0, 0, 0, 0.2);
}


.form input {
    font-family: "Roboto", sans-serif;
    outline: 0;
    background: #f2f2f2;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    box-sizing: border-box;
    font-size: 14px;
}

.form .message {
    margin: 15px;
    font-size: 12px;
}

</style>