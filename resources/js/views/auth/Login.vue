<template>

  <div class="container">
    <div class="row justify-content-md-center">

      <!-- <div class="alert alert-danger alert-block" role="alert"
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
      </div> -->

      <validation-errors v-if="validationErrors" :errors="validationErrors"></validation-errors>

        <div class="login-page">
          <form class="form">
            <img src="../../../img/logo.png" class="logo pb-5" alt="fsk logo">
            <h1 class="logo-title pb-3">Авторизация</h1>
            <my-input type="email" placeholder="Логин" v-model="user.email"></my-input>
            <my-input type="password" placeholder="Пароль" v-model="user.password"></my-input>
            <my-button type="submit" class="btn btn-primary btn-lg" @click.prevent="login">Войти <i class="bi bi-box-arrow-in-right"></i></my-button>
            <!-- <router-link to="/user/register"><p class="message">Еще не регистрироваилсь?</p><a href="#">Зарегистрироваться</a></router-link> -->
          </form>
          
        </div>

    </div>
  </div>

</template>
<script>
import { mapGetters } from "vuex"
import ValidationErrors from "../ui/ValidationErrors.vue";

export default {
  
  name: "Login",
  data() {
    return {
      user: {
        email:"",
        password: ""
      },
      isShowAlert: false
    }
  },
  methods: {
    login() {
      this.$store.dispatch("auth/loginUser", this.user)
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

.logo {
  width: 130px;
}

.alert-block {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.login-page {
    width: 600px;
    padding: 8% 0 0;
    margin: auto;
    display:flex;
}

.form {
    position: relative;
    // z-index: 1;
    background-size: cover;
    background-position: center;
    border-radius: 15px;
    max-width: 600px;
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
    font-size: 16px;
}

.form .message {
    margin: 15px;
    font-size: 12px;
}

</style>