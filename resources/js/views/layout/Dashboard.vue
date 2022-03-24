<template>

  <div class="container">
    <div class="row header">
      <Header></Header>
    </div>

    <div class="row main-block">     
      <div class="col-xl-3 main-sidebar">
        <Sidebar></Sidebar>
      </div>
      <div class="col-xl-9 main-body">
        <Users></Users>
      </div>
    </div>
  </div>

</template>

<script>
import Header from "../ui/Header";
import Sidebar from "./Sidebar";
import Users from "./Users";

export default {
    name: "Dashboard",
    components: {
      Header,
      Sidebar,
      Users
    }
}
</script>

<style scoped>

  .header {
    background-color: rgb(255, 255, 255);
  }

  .main-sidebar{
    background-color: rgb(255, 255, 255);
  }

  .main-body{
    background-color: #F5EFFF;
  }

</style>
