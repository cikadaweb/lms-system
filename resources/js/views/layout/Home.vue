<template>

  <div class="container">
    <div class="row header">
      <Header></Header>
    </div>

    <div class="row main-block">     
      <div class="col-3 main-sidebar">
        <Sidebar></Sidebar>
      </div>
      <div class="col-9 main-body">
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
    background-color: orange;
  }

  .main-sidebar{
    background-color: red;
  }

  .main-body{
    background-color: yellow;
  }

  .main-block {
    height: 1100px;
  }


</style>