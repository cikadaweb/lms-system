<template>

  <div class="custom-container">
    <div class="row header">
      <Header></Header>
    </div>

    <div class="row main-block">     

      <div class="col-xl-2 main-sidebar">
        <Sidebar></Sidebar>
      </div>

      <div class="col-xl-10 main-body">

        <AppLoader v-if="loading"></AppLoader>

        <Main
          v-else 
          :panelState = panelState
        ></Main>
      </div>
    </div>
  </div>

</template>



<script>
import axios from "../../../axios/axios-instance";
import Header from "../ui/Header";
import AppLoader from "../ui/AppLoader";
import Main from "./Main";
import Sidebar from "./Sidebar";

export default {
    components: {
        Header,
        Sidebar,
        Main,
        AppLoader
    },
    data() {
      return {
        loading: true,
        panelState: [],
      }
    },
    created() {
      this.getPanelInfo()
    },
    methods: {
      getPanelInfo() {
        this.loading = true
        axios.get("/api/getState")
        .then(response => {
          this.panelState = response.data
          this.loading = false
          // console.log(this.panelState)
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

.container {
  margin-bottom: 15px;
}

.custom-container-crud {
    background-color: rgb(255, 255, 255);
    border-radius: 15px;
    padding: 50px;
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
    margin-bottom: 15px;
  }

  li {
    list-style-type: none; 
  }
  ul {
    margin-left: 0; 
    padding-left: 0;
  }
  

</style>