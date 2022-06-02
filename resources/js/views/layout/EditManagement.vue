<template>

  <div class="container">
    <div class="row justify-content-md-center">

        <div class="dashboard-modal__user-edit">
          
          <form @submit.prevent="updateUserData" class="role-edit-form d-flex flex-column">
            
            <h3>Редактирование роли</h3>

            <my-input type="text" placeholder="наименование роли" v-model="role.name"></my-input>

            <div class="popup-buttons d-flex justify-content-between mt-3">
              <my-button class="btn-success" @click="updateRoles">Обновить</my-button>
              <router-link :to="'/user/management'">
                  <my-button class="btn-danger">Отменить</my-button>
              </router-link>
            </div>

          </form>
        </div>

    </div>
  </div>

</template>
<script>
import axios from "../../../axios/axios-instance";

export default {
  
  name: "EditManagement",
  data() {
    return {
      role: {
        name:"",
      }
    }
  },
  methods: {
    updateRoles() {
        axios
            .put("/api/roles/" + this.$route.params.id, {
                name: this.role.name,
            })
            .then((response) => {
              this.$router.push("/user/management");
            });
    },
  },
  
}
</script>



<style scoped lang="scss">

.role-edit-form{
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