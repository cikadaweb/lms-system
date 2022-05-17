<template>

  <div class="custom-container">
    <div class="row header">
      <Header></Header>
    </div>

    <div class="row main-block">     

      <div class="col-xl-2 main-sidebar" v-if="userRole == 'Admin'">
        <Sidebar></Sidebar>
      </div>
      <div class="col-xl-2 main-sidebar" v-else-if="userRole == 'Master'">
        <Sidebar></Sidebar>
      </div>
      <div class="col-xl-2 main-sidebar" v-else>
        <UserSidebar></UserSidebar>
      </div>

      <div class="col-xl-10 main-body">
        <Main 
          :panelState = panelState
        ></Main>
      </div>
    </div>
  </div>

</template>



<script>

import axios from "../../../axios/axios-instance";
import Header from "../ui/Header";
import Main from "./Main";
import Sidebar from "./Sidebar";
import UserSidebar from "./User/UserSidebar.vue";

export default {
    components: {
        Header,
        Sidebar,
        Main,
        UserSidebar
    },
    data() {
      return {
        userRole: "",
        panelState: []
      }
    },
    mounted() {
      this.getData()
      this.getPanelInfo()
    },
    methods: {
      getData() {
        axios.get("/api/getRole")
        .then(response => {
          this.userRole = response.data
        })
      },
      getPanelInfo() {
        axios.get("/api/getState")
        .then(response => {
          this.panelState = response.data
          console.log(this.panelState)
        })
      },
    }

}
</script>



<style lang="scss">
// тут будут главные стили, которые и на Dashboard распространяются

a {
  text-decoration: none;
}

.custom-container {
  margin: 10px 30px;
}

  .header {
    background-color: rgb(255, 255, 255);
    border-radius: 15px 15px 0 0;
  }

  .main-sidebar{
    background-color: rgb(255, 255, 255);
    border-radius: 0 0 15px 15px;
  }

  .main-block{
    background-color: rgb(255, 255, 255);
    padding-right: 12px;
    border-radius: 0 0 15px 15px;

    // осторожно тут значение!
    min-height: 650px;
  }

  .main-body{
    background-color: #F5EFFF;
    border-radius: 15px;
    padding-right: 10px;
  }

  li {
    list-style-type: none; 
  }
  ul {
    margin-left: 0; 
    padding-left: 0;
  }
  

</style>