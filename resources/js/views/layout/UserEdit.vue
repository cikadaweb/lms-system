<template>

  <div class="container">
    <div class="row justify-content-md-center">
        <div class="user-page">
          
          <form class="form">
            <h1>Edit User</h1>
            <my-input type="text" placeholder="username" v-model="user.name"></my-input>
            <my-input type="text" placeholder="email" v-model="user.email"></my-input>
            <my-button class="btn-success" @click="updateUsers">Update</my-button>
          </form>
        </div>
    </div>
  </div>

</template>
<script>
import axios from "../../../axios/axios-instance";

export default {
  
  name: "UserEdit",
  data() {
    return {
      user: {
        name:"",
        email: ""
      }
    }
  },
  methods: {
    updateUsers() {
        axios
            .put("/api/users/" + this.$route.params.id, {
                name: this.user.name,
                email: this.user.email,
            })
            .then((response) => {
              // this.$router.push({name: "Dashboard"});
              window.location.replace("/user/dashboard");
            });
    },
  }
}
</script>



<style scoped lang="scss">

.user-page {
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