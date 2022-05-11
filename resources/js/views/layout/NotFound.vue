<template>

  <div class="container">
    <div class="row justify-content-md-center">

        <div class="login-page">
          <form class="form">
            <h2>Упс, похоже страница не найдена!</h2>
            <router-link to="/user/login">
              Перейти к авторизации
            </router-link>
          </form>
          
        </div>

    </div>
  </div>

</template>

<script>
export default {
  
}
</script>

<style scoped lang="scss">
.login-page {
    width: 450px;
    padding: 8% 0 0;
    margin: auto;
    display:flex;
}

.form {
    position: relative;
    // z-index: 1;
    background-size: cover;
    background-position: center;
    border-radius: 15px;
    max-width: 450px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.5), 0 5px 0 rgba(0, 0, 0, 0.2);
}


</style>