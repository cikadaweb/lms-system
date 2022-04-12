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
        <Users></Users>
      </div>
    </div>
  </div>

</template>

<script>
import Header from "../../ui/Header.vue";
import Sidebar from "../Sidebar.vue";
import Users from "./Users.vue";

export default {
    name: "Dashboard",
    components: {
      Header,
      Sidebar,
      Users
    }
}
</script>

<style lang="scss">


</style>
