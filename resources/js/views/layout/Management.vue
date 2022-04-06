<template>

  <div class="container">
    <div class="row pt-3">
      
      <h2>Разрешения пользователей:</h2>

      <my-window v-if="isPopupVisible" @close="closePopup">
        <ul class="popup">
          <li>
            <form>

              <my-input type="text" placeholder="role" v-model="role.name"  />

            </form>
          </li>
          <li>        
            <div class="popup__footer pt-3">
              <my-button class="btn-success" @click="addRoles">Добавить</my-button>
              <my-button class="btn-danger"  @click="popup">Отменить</my-button>
            </div>
          </li>
        </ul>
      </my-window>

      <div class="table-btn pt-2 pb-3">
        <my-button class="btn-success" @click="popup">Добавить роль</my-button>
      </div>

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

  .popup__footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .table-btn{
    display: flex;
  }
  

</style>