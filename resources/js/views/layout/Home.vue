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
        <Main></Main>
      </div>
    </div>
  </div>

</template>



<script>

import axios from "../../../axios/axios-instance";
import Header from "../ui/Header";
import Main from "./Main";
import Sidebar from "./Sidebar";

export default {
    components: {
        Header,
        Sidebar,
        Main
    },
    mounted() {
      // toDo
      // this.getData()
    },
    methods: {
      getData() {
        axios.get("/api/get")
        .then(response => {
          console.log(response)
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