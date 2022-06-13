<template>

  <div class="container">

    <div class="row pt-3">
      <div class="col-xl-12">

        <div class="dashboard-panel__title row pt-3">
          <div class=" col-xl-12">
            <h1>Главная</h1>
          </div>
        </div>

        <div class="row pt-3">
          <div class=" col-xl-12">
            <h2>Результаты тестов:</h2>
          </div>
        </div>

      </div>

    </div>
  </div>

</template>



<script>

export default {
  name: "UserMain",
  components: {},
  data() {
    return {
    }
  },

}
</script>



<style scoped lang="scss">

.card:hover {
  transform: scale(1.1);
  transition-duration: .5s;
}

.chart{
  background-color: rgb(255, 255, 255);
  padding: 10px 10px;
  border-radius: 15px;
}

.card-icons {
  width: 50px;
  height: 50px;
}

.state-link {
  color: white;
}

</style>