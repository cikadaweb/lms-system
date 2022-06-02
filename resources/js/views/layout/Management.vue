<template>

  <div class="container custom-container-crud mt-3">
    <div class="row pt-2">
      <div class="col-xl-12">

        <div class="dashboard-panel__title row pt-2">
          <div class="col-xl-12 nav">
            <h1>Роли в системе</h1>
            <router-link :to="'/'"><h5><i class="bi bi-arrow-left-circle"></i> Вернуться на главную</h5></router-link>
          </div>
        </div>

        <div class="dashboard-panel-buttons row pt-3">
          <div class="col-xl-12 d-flex justify-content-between">
            <div class="dashboard-panel__btn table-btn ps-2">
              <my-button class="btn-success" @click="popup">
                <span class="me-3">Добавить роль</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-plus" viewBox="0 0 16 16">
                  <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H1s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C9.516 10.68 8.289 10 6 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
                  <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                </svg>
              </my-button>
            </div>
          </div>
        </div>

        <div class="dashboard-modal row pt-3">
          <div class="col-xl-12">
            <my-window 
              v-if="isPopupVisible" 
              @close="closePopup"
              title="Добавление роли" 
            >

              <div class="d-flex flex-column">
                <my-input type="text" placeholder="Наименование роли" v-model="role.name"  />


                <div class="popup-buttons d-flex justify-content-between mt-3">
                    <my-button class="btn-success" @click="addRoles">Добавить</my-button>
                    <my-button class="btn-danger"  @click="popup">Отменить</my-button>
                </div>

              </div>
            </my-window>
          </div>
        </div>

        <div class="dashboard-panel__table row pt-2">
          <div class=" col-xl-12">
            <table class="table table-success table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Разрешение</th>
                  <th>Редактировать</th>
                  <th>Удалить</th>
                </tr>
              </thead>
              <tbody >
                <tr v-for="(role, idx) in getRoles" :key="role.id">
                  <th>{{ idx + 1 }}</th>
                  <td v-if="role.name">{{ role.name }}</td>
                  <td v-else>N/A</td>
                  <td>
                      <router-link :to="{name: 'EditManagement', params:{id: role.id}}">
                        <my-button class="btn-outline-success">Редактировать</my-button>
                      </router-link>
                  </td>
                  <td>
                      <my-button class="btn-outline-danger" @click="deleteRoles(role.id)">Удалить</my-button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>
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
      role: {
        name: '',
      }
    }
  },
  created() {
    this.$store.dispatch("users/getRoles")
  },
  methods: {
    popup() {
        this.isPopupVisible = !this.isPopupVisible
    },
    closePopup() {
        this.isPopupVisible = false
    },
    addRoles() {
        this.$store.dispatch('users/addRole', this.role)
        this.$store.dispatch("users/getRoles")
    },
    deleteRoles(id) {
        axios.delete('/api/roles/' + id).then(res => {
            this.$store.dispatch('users/getRoles')
        });
    },
},
computed: {
    getRoles: {
        get() {
            return this.$store.state.users.roleList
        }
    },
}
}
</script>



<style scoped lang="scss">

  // .popup__footer {
  //   display: flex;
  //   justify-content: space-between;
  //   align-items: center;
  // }

  // .table-btn{
  //   display: flex;
  // }
  

</style>