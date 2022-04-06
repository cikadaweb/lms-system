<template>

  <div class="container">
    <div class="row pt-3">
      
      <h2>Разрешения пользователей:</h2>

      <my-window v-if="isPopupVisible" @close="closePopup">
        <ul class="popup">
          <li>
            <form>

              <my-input type="text" placeholder="permission" v-model="permission.name"  />

            </form>
          </li>
          <li>        
            <div class="popup__footer pt-3">
              <my-button class="btn-success" @click="addPermission">Добавить</my-button>
              <my-button class="btn-danger"  @click="popup">Отменить</my-button>
            </div>
          </li>
        </ul>
      </my-window>

      <div class="table-btn pt-2 pb-3">
        <my-button class="btn-success" @click="popup">Добавить разрешение</my-button>
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
          <tr v-for="(permission, idx) in getPermissions" :key="permission.id">
            <th>{{ idx + 1 }}</th>
            <td v-if="permission.name">{{ permission.name }}</td>
            <td v-else>N/A</td>
            <td>
                <router-link :to="{name: 'EditPermissions', params:{id: permission.id}}">
                  <my-button class="btn-outline-success">Редактировать</my-button>
                </router-link>
            </td>
            <td>
                <my-button class="btn-outline-danger" @click="deletePermission(permission.id)">Удалить</my-button>
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
      permission: {
        name: '',
      }
    }
  },
  created() {
    this.$store.dispatch("users/getPermissions")
  },
  methods: {
    popup() {
        this.isPopupVisible = !this.isPopupVisible
    },
    closePopup() {
        this.isPopupVisible = false
    },
    addPermission() {
        this.$store.dispatch('users/addPermission', this.permission)
    },
    deletePermission(id) {
        axios.delete('/api/permissions/' + id).then(res => {
            this.$store.dispatch('users/getPermissions')
        });
    },
},
computed: {
    getPermissions: {
        get() {
            return this.$store.state.users.permissionsList
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