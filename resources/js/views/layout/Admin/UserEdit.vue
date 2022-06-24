<template>

  <div class="container">
    <div class="row justify-content-md-center">

        <div class="dashboard-modal__user-edit">
          
          <form @submit.prevent="updateUserData" class="user-edit-form d-flex flex-column">
            
            <!-- <h3>Редактирование пользователя {{ this.$route.params.id }}</h3> -->
            <h3>Редактирование пользователя</h3>

            <my-input type="text" placeholder="ФИО пользователя" v-model="user.name"></my-input>
            <span class="d-flex">Текущее значение: {{ getUserData.name }}</span>

            <my-input type="text" placeholder="Email почта" v-model="user.email"></my-input>
            <span class="d-flex">Текущее значение: {{ getUserData.email }}</span>
            
            <select 
              class="form-select d-block mt-3" 
              aria-label="Роль"
              v-model="user.role.name" 
            >
              <option value="" selected>Выберите роль пользователя</option>
              <option 
              v-for="role in getRoles"
              :key="role.id" 
              :value="role.name"
              >{{ role.name }}</option>
            </select>

            <div class="popup-buttons d-flex justify-content-between mt-3">
              <my-button type="submit" class="btn-success">
                Обновить
              </my-button>
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
    this.$store.dispatch("users/getUserData", this.$route.params.id)
    this.$store.dispatch("users/getRoles")
  },
  methods: {

    updateUserData() {
      this.$store.dispatch("users/updateUserData", {
        id: this.$route.params.id,
        name: this.user.name,
        email: this.user.email,
        role: this.user.role.name,
      })
    },
  },
  computed: {
    getUserData: {
      get() {
        return this.$store.state.users.currentUser
      }
    },
    getRoles: {
      get() {
        return this.$store.state.users.roleList
      }
    }
  }
  
}
</script>



<style scoped lang="scss">

.user-edit-form{
    position: relative;
    // z-index: 1;
    background-size: cover;
    background-position: center;
    max-width: 600px;
    border-radius: 15px;
    margin: 100px auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.5), 0 5px 0 rgba(0, 0, 0, 0.2);
}

</style>