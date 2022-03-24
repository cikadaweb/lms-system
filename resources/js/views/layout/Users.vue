<template>

  <div class="container">
    <div class="row pt-3">
      
      <h2>Пользователи:</h2>

    <my-window v-if="isPopupVisible" @close="closePopup">
        <form>
            <my-input type="text" placeholder="username"  />
            <my-input type="text" placeholder="email address"  />
            <my-input type="password" placeholder="password"  />
            <my-input type="password" placeholder="password confirmation"  />
        </form>
    </my-window>

      <table class="table table-success table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Логин</th>
            <th scope="col">Почта</th>
            <th scope="col">Пароль</th>
            <th>Редактировать</th>
            <th>Удалить</th>
            <th>
              <my-button class="btn-success" @click="popup">Add</my-button>
            </th>
          </tr>
        </thead>
        <tbody >
          <tr v-for="user in getUsers" :key="user.id">
            <th>{{ user.id }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.password }}</td>
            <td>
                <my-button class="btn-outline-success" @click="popup">  Edit </my-button>
            </td>
            <td>
                <my-button class="btn-outline-danger"> Delete </my-button>
            </td>
            <td></td>
          </tr>
        </tbody>
      </table>

    </div>
  </div>

</template>



<script>
import MyWindow from "../ui/MyWindow";

export default {
  components: {
    MyWindow
  },
  data() {
    return {
      isPopupVisible: false
    }
  },
  created() {
    this.$store.dispatch("users/getUsers")
  },
  methods: {
    popup() {
        this.isPopupVisible = true
    },
    closePopup() {
        this.isPopupVisible = false
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


</style>