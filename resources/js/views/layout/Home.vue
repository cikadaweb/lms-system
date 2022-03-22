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
        <Main></Main>
      </div>
    </div>
  </div>

</template>



<script>
import Header from "./Header";
import Main from "./Main";
import Sidebar from "./Sidebar";
export default {
    components: {
        Header,
        Sidebar,
        Main
    }
}
</script>



<style scoped lang="scss">

  .header {
    background-color: rgb(255, 255, 255);
  }

  .main-sidebar{
    background-color: rgb(255, 255, 255);
  }

  .main-body{
    background-color: #F5EFFF;
  }

  .main-block {
  }


</style>