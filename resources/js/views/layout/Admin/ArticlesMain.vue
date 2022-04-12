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
        <ArticlesDashboard></ArticlesDashboard>
      </div>
    </div>
  </div>

</template>

<script>
import Header from "../../ui/Header.vue";
import Sidebar from "../Sidebar.vue";
import ArticlesDashboard from "./ArticlesDashboard.vue";

export default {
    name: "ArticlesMain",
    components: {
      Header,
      Sidebar,
      ArticlesDashboard
    }
}
</script>

<style lang="scss">


</style>
