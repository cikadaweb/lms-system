<template>

  <div class="container">
    <div class="row pt-3">
      

      <div class="col-xl-12 d-flex pb-3">

        <div class="pe-5">
          <h2>Пользователи:</h2>
        </div>

        <div class="table-btn pt-2 pb-3">
          <my-button class="btn-success" @click="popup">Добавить пользователя</my-button>
        </div>

      </div>

      <div class="col-xl-12">
        <my-window v-if="isPopupVisible" @close="closePopup">
          <ul class="popup">
            <li>
              <form>
                <my-input type="text" placeholder="username" v-model="user.name"  />
                <my-input type="text" placeholder="email address" v-model="user.email" />
                <my-input type="password" placeholder="password" v-model="user.password" />
                <my-input type="password" placeholder="password confirmation" v-model="user.password_confirmation" />

                <label for="" class="form-label mt-2">Роль пользователя:</label>
                <select class="form-select mb-3" v-model="user.role.name">
                  <option disabled selected>Выберите роль</option>
                  <option v-for="role in getRoles" :key="role.id">
                    {{ role.name }}
                  </option>
                </select>

              </form>
            </li>
            <li>        
              <div class="popup__footer pt-3">
                <my-button class="btn-success" @click="addUser">Добавить</my-button>
                <my-button class="btn-danger"  @click="popup">Отменить</my-button>
              </div>
            </li>
          </ul>
        </my-window>
      </div>

      <div class="col-xl-12">
        <nav class="table-nav d-flex justify-content-between">
                <div>
                  <form class="d-flex pe-3">
                      <input class="form-control me-2 table-nav__input" type="search" placeholder="Найти" aria-label="Search">
                  </form>
                </div>
                <div class="table-nav-selects">
                  <select class="form-select table-nav__select me-2" aria-label="Default select example">
                    <option selected>Все даты</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>

                  <select class="form-select table-nav__select" aria-label="Default select example">
                    <option selected>Статус</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
        </nav>
      </div>

      <div class="col-xl-12">
        <table class="table table-success table-striped">
          <thead>
            <tr>
              <th class="tabel-label">#</th>
              <th class="tabel-label">Логин</th>
              <th class="tabel-label">Почта</th>
              <th class="tabel-label">Роль</th>
              <th class="tabel-label">Редактировать</th>
              <th class="tabel-label">Удалить</th>
            </tr>
          </thead>
          <tbody >
            <tr v-for="(user, idx) in getUsers" :key="user.id">
              <th>{{ idx + 1 }}</th>
              <td>{{ user.name }}</td>
              <td>{{ user.email }}</td>
              <td v-if="user.role">{{ user.role.name }}</td>
              <td v-else>N/A</td>
              <td>
                  <router-link :to="{name: 'UserEdit', params:{id: user.id}}">
                    <my-button class="btn-outline-success"><i class="bi bi-pencil-square"></i> Редактировать</my-button>
                  </router-link>
              </td>
              <td>
                  <my-button class="btn-outline-danger" @click="deleteUser(user.id)"><i class="bi bi-trash"></i> Удалить</my-button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

    </div>
  </div>

</template>



<script>
import MyWindow from "../../ui/MyWindow.vue";
import axios from "../../../../axios/axios-instance";

export default {
  name: "UsersDashboard",
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
        password_confirmation: '',
        role: {
          name: "",
        }
      }
    }
  },
  created() {
    this.$store.dispatch("users/getUsers")
    this.$store.dispatch("users/getRoles")
  },
  methods: {

    popup() {
        this.isPopupVisible = !this.isPopupVisible
    },

    closePopup() {
        this.isPopupVisible = false
    },

    clearPopup() {
      this.user.name = ""
      this.user.email = ""
      this.user.password = ""
      this.user.password_confirmation = ""
      this.user.role.name = ""
    },

    addUser() {
      this.$store.dispatch("users/addUser", this.user)
      this.$store.dispatch("users/getUsers")
      this.clearPopup()
      this.closePopup()
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
    },
    getRoles: {
      get() {
        return this.$store.state.users.roleList
      }
    }
  }
}
</script>



<style lang="scss">

.form-select {
  background-color: rgb(255, 255, 255);
}

  .popup__footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

</style>