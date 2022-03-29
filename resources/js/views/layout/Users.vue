<template>

  <div class="container">
    <div class="row pt-3">
      
      <h2>Пользователи:</h2>

      <my-window v-if="isPopupVisible" @close="closePopup">
        <ul class="popup">
          <li>
            <form>
              <my-input type="text" placeholder="username" v-model="user.name"  />
              <my-input type="text" placeholder="email address" v-model="user.email" />
              <my-input type="password" placeholder="password" v-model="user.password" />
              <my-input type="password" placeholder="password confirmation" v-model="user.password_confirmation" />
            </form>
          </li>
          <li>        
            <div class="popup__footer pt-2">
              <my-button class="btn-success" @click="addUser">Добавить</my-button>
              <my-button class="btn-danger"  @click="popup">Отменить</my-button>
            </div>
          </li>
        </ul>
      </my-window>

      <div class="table-btn pt-2 pb-3">
        <my-button class="btn-success" @click="popup">Добавить пользователя</my-button>
      </div>

      <table class="table table-success table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Логин</th>
            <th scope="col">Почта</th>
            <th scope="col">Роль</th>
            <th>Редактировать</th>
            <th>Удалить</th>
          </tr>
        </thead>
        <tbody >
          <tr v-for="(user, idx) in getUsers" :key="user.id">
            <th>{{ idx }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>Администратор</td>
            <td>
                <router-link :to="{name: 'UserEdit', params:{id: user.id}}">
                  <my-button class="btn-outline-success">Редактировать</my-button>
                </router-link>
            </td>
            <td>
                <my-button class="btn-outline-danger" @click="deleteUser(user.id)">Удалить</my-button>
            </td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

</template>



<script>
import MyWindow from "../ui/MyWindow";
import axios from "../../../axios/axios-instance";

export default {
  components: {
    MyWindow
  },
  data() {
    return {
      isPopupVisible: false,
      user: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  created() {
    this.$store.dispatch("users/getUsers")
  },
  methods: {

    popup() {
        this.isPopupVisible = !this.isPopupVisible
    },

    closePopup() {
        this.isPopupVisible = false
    },

    addUser() {
      this.$store.dispatch("users/addUser", this.user)
    },
  
    deleteUser(id) {
      axios.delete("/api/users/" + id)
        .then((response) => {
          this.$store.dispatch("users/getUsers")
      })
    },

  },
  computed: {
    getUsers: {
      get() {
        return this.$store.state.users.userList
      }
    }
  }
}
</script>



<style scoped lang="scss">

  .popup__footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .table-btn{
    display: flex;
  }

  li {
    list-style-type: none; 
  }
  ul {
    margin-left: 0; 
    padding-left: 0;
  }
  

</style>