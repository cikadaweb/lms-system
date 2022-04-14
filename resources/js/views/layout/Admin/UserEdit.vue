<template>

  <div class="container">
    <div class="row justify-content-md-center">
        <div class="user-page">
          
          <form class="form">
            <h3>Редактирование пользователя</h3>
            <my-input type="text" placeholder="username" v-model="user.name"></my-input>
            <my-input type="text" placeholder="email" v-model="user.email"></my-input>

            <label for="" class="form-label">Роль пользователя:</label>
            <select class="form-select mb-3" v-model="user.role.name">
              <option disabled selected>Выберите роль</option>
              <option v-for="role in getRoles" :key="role.id">
                {{ role.name }}
              </option>
            </select>

            <div class="form-buttons">
              <my-button class="btn-success" @click="updateUsers">Обновить</my-button>
              <router-link :to="'/users/dashboard'">
                  <my-button class="btn-danger">Отменить</my-button>
              </router-link>
            </div>

          </form>
        </div>
    </div>
  </div>

</template>
<script>
import axios from "../../../../axios/axios-instance";

export default {
  
  name: "UserEdit",
  data() {
    return {
      user: {
        name:"",
        email: "",
        role: {
          name: "",
        }
      }
    }
  },
  created() {
    this.$store.dispatch("users/getRoles")
  },
  methods: {
    updateUsers() {
        axios
            .put("/api/users/" + this.$route.params.id, {
                name: this.user.name,
                email: this.user.email,
                role: this.user.role.name
            })
            .then((response) => {
              this.$router.push({name: "UsersMain"});
              // window.location.replace("/users/dashboard");
            });
    },
  },
  computed: {
    getRoles: {
      get() {
        return this.$store.state.users.roleList
      }
    }
  }
  
}
</script>



<style scoped lang="scss">

.form-select {
  background-color: rgb(255, 255, 255);
}

.user-page {
    width: 450px;
    padding: 8% 0 0;
    margin: auto;
    display:flex;
}

.form {
    position: relative;
    // z-index: 1;
    background-size: cover;
    background-position: center;
    max-width: 450px;
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
    color: #b3b3b3;
    font-size: 12px;
}

.form-label {
  display: flex;
}

.form-buttons {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

</style>