<template>

  <div class="container">
    <div class="row justify-content-md-center">
        <div class="login-page">
          
          <form class="form">
            <my-input type="email" placeholder="email address" v-model="user.email"></my-input>
            <my-input type="password" placeholder="password" v-model="user.password"></my-input>
            <my-button type="submit" class="btn-success" @click.prevent="login">Login</my-button>
            <router-link to="/user/register"><p class="message">Not Registered?</p><a href="#">Create an account</a></router-link>
          </form>
          
        </div>
    </div>
  </div>

</template>
<script>

export default {
  
  name: "Login",
  data() {
    return {
      user: {
        email:"",
        password: ""
      }
    }
  },
  methods: {
    login() {
      this.$store.dispatch("auth/loginUser", this.user)
    }
  }
}
</script>



<style scoped lang="scss">

.login-page {
    width: 360px;
    padding: 8% 0 0;
    margin: auto;
    display:flex;
}

.form {
    position: relative;
    z-index: 1;
    background-color: var(--color-grey-dark-1);
    background-size: cover;
    background-position: center;
    max-width: 360px;
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
    color: #b3b3b3;
    font-size: 12px;
}
.form .message a {
    text-decoration: none;
    color: var(--color-grey-light-4);
}

</style>