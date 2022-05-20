<template>

  <div class="container">
    <div class="row pt-3">

      <div class="dashboard-panel__title col-xl-12 pt-2">
        <h1>Пользователи</h1>
      </div>

      <div class="dashboard-panel-filter col-xl-12 d-flex justify-content-between pt-3">
          <div class="panel-filter-left">
            <form class="d-flex">
              <input class="form-control panel-input" v-model="search_input" @input="getUsersBySearch" type="search" placeholder="Имя пользователя" aria-label="Search">
              <button class="btn btn-primary" @click.prevent type="submit"><i class="bi bi-search"></i></button>
            </form>
          </div>

          <div class="panel-filter-right d-flex">

            <select class="form-select me-5">
              <option selected>Статус пользователя</option>
              <option value="1">Активный</option>
              <option value="2">Неактивный</option>
            </select>

            <select 
              class="form-select" 
              aria-label="Роль"
              v-model="filter_role" 
              @change="filterUsersByStatus"
            >
              <option value="" selected>Роль пользователя</option>
              <option 
              v-for="role in getRoles"
              :key="role.id" 
              :value="role.name"
              >{{ role.name }}</option>
            </select>

          </div>
      </div>

      <div class="dashboard-panel-buttons col-xl-12 d-flex justify-content-between pt-3">

        <div class="dashboard-panel__btn table-btn ps-2">
          <my-button class="btn-success" @click="popup">
            <span class="me-3">Добавить пользователя</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
              <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
              <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
            </svg>
          </my-button>
        </div>

        <div class="dashboard-panel__btn table-btn ps-2">
          <my-button class="btn-primary">
             Импорт 
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-filetype-xls" viewBox="0 0 16 16">
              <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM6.472 15.29a1.176 1.176 0 0 1-.111-.449h.765a.578.578 0 0 0 .254.384c.07.049.154.087.25.114.095.028.202.041.319.041.164 0 .302-.023.413-.07a.559.559 0 0 0 .255-.193.507.507 0 0 0 .085-.29.387.387 0 0 0-.153-.326c-.101-.08-.255-.144-.462-.193l-.619-.143a1.72 1.72 0 0 1-.539-.214 1.001 1.001 0 0 1-.351-.367 1.068 1.068 0 0 1-.123-.524c0-.244.063-.457.19-.639.127-.181.303-.322.527-.422.225-.1.484-.149.777-.149.305 0 .564.05.78.152.216.102.383.239.5.41.12.17.186.359.2.566h-.75a.56.56 0 0 0-.12-.258.625.625 0 0 0-.247-.181.923.923 0 0 0-.369-.068c-.217 0-.388.05-.513.152a.472.472 0 0 0-.184.384c0 .121.048.22.143.3a.97.97 0 0 0 .405.175l.62.143c.217.05.406.12.566.211a1 1 0 0 1 .375.358c.09.148.135.335.135.56 0 .247-.063.466-.188.656a1.216 1.216 0 0 1-.539.439c-.234.105-.52.158-.858.158-.254 0-.476-.03-.665-.09a1.404 1.404 0 0 1-.478-.252 1.13 1.13 0 0 1-.29-.375Zm-2.945-3.358h-.893L1.81 13.37h-.036l-.832-1.438h-.93l1.227 1.983L0 15.931h.861l.853-1.415h.035l.85 1.415h.908L2.253 13.94l1.274-2.007Zm2.727 3.325H4.557v-3.325h-.79v4h2.487v-.675Z"/>
            </svg>
          </my-button>
        </div>

      </div>

      <div class="dashboard-panel-results" v-if="isShowResultSatus">
        <div class="pt-3" v-if="getUsers.length > 0">
          <h2>Результаты по запросу: {{ search_input }}</h2>
          <p class="lead">Всего найдено {{ getUsers.length }} постов.</p>
        </div>
        <div class="pt-3" v-else >
          <h2>По запросу {{ search_input }} ничего не найдено.</h2>
          <a href="" @click.prevent="search_input = ''">Отобразить все посты</a>
        </div>
      </div>

      <div class="dashboard-panel__table col-xl-12 pt-2">
        <table class="table table-success table-striped">
          <thead>
            <tr>
              <th class="tabel-label">ID</th>
              <th class="tabel-label">ФИО</th>
              <th class="tabel-label">Почта</th>
              <th class="tabel-label">Роль</th>
              <th class="tabel-label">Редактировать</th>
              <th class="tabel-label">Удалить</th>
            </tr>
          </thead>
          <tbody >
            <tr v-for="user in getUsers" :key="user.id">
              <th>{{ user.id }}</th>
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

      <div class="col-xl-12 d-flex justify-content-center">
        <Pagination v-if="search_input == ''"
          :pagination_url="pagination_url"
          v-on:set-paginate-items="setPaginateUsers"
        ></Pagination>
      </div>

      <div class="dashboard-modal col-xl-12 pt-3">
        <my-window 
          v-if="isPopupVisible" 
          @close="closePopup"
          title="Добавление пользователя" 
        >
          <validation-errors v-if="userAddErrors" :errors="userAddErrors" class="pt-2"></validation-errors>

          <div class="d-flex flex-column">
            <my-input type="text" placeholder="ФИО пользователя" v-model="user.name"  />
            <my-input type="text" placeholder="Email почта" v-model="user.email" />
            <my-input type="password" placeholder="Пароль" v-model="user.password" />
            <my-input type="password" placeholder="Подтверждение пароля" v-model="user.password_confirmation" />

            <select 
              class="form-select d-block mt-3" 
              aria-label="Роль"
              v-model="user.role.name" 
            >
              <option value="" selected>Роль пользователя</option>
              <option 
              v-for="role in getRoles"
              :key="role.id" 
              :value="role.name"
              >{{ role.name }}</option>
            </select>

            <div class="popup-buttons d-flex justify-content-between mt-3">
                <my-button class="btn-success" @click="addUser">Добавить</my-button>
                <my-button class="btn-danger"  @click="popup">Отменить</my-button>
            </div>

          </div>
        </my-window>
      </div>

    </div>
  </div>

</template>



<script>
import Pagination from "../../ui/Pagination.vue"
import MyWindow from "../../ui/MyWindow.vue";
import ValidationErrors from "../../ui/ValidationErrors.vue";

export default {
  name: "UsersDashboard",
  components: {
    MyWindow,
    Pagination,
    ValidationErrors
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
      },
      pagination_url: "http://127.0.0.1:8000/api/users",
      search_input: "",
      filter_role: "",
      status_user: "",
      isShowResultSatus: false
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
        this.user.name = ""
        this.user.email = ""
        this.user.password = ""
        this.user.password_confirmation = ""
        this.user.role.name = ""
        this.isPopupVisible = false
    },

    addUser() {
      this.$store.dispatch("users/addUser", this.user)
      this.$store.dispatch("users/getUsers")
      // this.closePopup()

    },
  
    deleteUser(id) {
      this.$store.dispatch("users/deleteUser", id)
      this.$store.dispatch("users/getUsers")
    },

    setPaginateUsers(users) {
      this.$store.commit("users/setUsersList", users.data.data , { root: true })
    },

    getUsersBySearch() {
      if (this.search_input !== '') {
        this.isShowResultSatus = true
        this.$store.dispatch("users/getUsersBySearch", this.search_input)
      } else {
        this.isShowResultSatus = false
      }
    },
  
    filterUsersByStatus() {
      this.$store.dispatch("users/filterUsersByStatus", this.filter_role)
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
    },
    userAddErrors: {
      get() {
        return this.$store.state.users.errors
      }
    },
  }
}
</script>



<style lang="scss">
// здесь глобальные стили для dashboard-panel

.dashboard-panel-filter {
  background-color: white;
  padding: 20px;
  border-radius: 15px;
}

.form-select {
  background-color: rgb(255, 255, 255);
  width: auto;
}

// здесь стили для dashboard-panel

.tabel-label {
  background-color: #F5EFFF !important;
}

</style>