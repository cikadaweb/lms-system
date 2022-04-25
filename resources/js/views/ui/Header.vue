<template>

    <header class="header">
        <router-link :to="'/'"><img src="../../../img/logo.png" class="logo" alt="fsk logo"></router-link>
        <span>Вы находитесь в системе уже: 45 минут </span>
        <nav class="user-nav">
            <div class="user-nav__user">

                <form class="d-flex pe-3">
                    <input class="form-control me-2 user-nav-input" type="search" placeholder="Найти на странице" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form>

                <!-- <img src="../../../img/user.png" alt="User Photo" class="user-nav__user-photo"> -->
                <!-- <router-link v-if="token" :to="'/user/register'"><span class="user-nav__user-name">Регистрация</span></router-link>
                <router-link v-if="token" :to="'/user/login'"><span class="user-nav__user-name">Авторизация</span></router-link> -->
                <my-button v-if="!token" class="btn-danger" type="submit" @click.prevent="logout">Выход</my-button>
                
            </div>
        </nav>
    </header>

</template>



<script>

export default {
    data() {
      return {
        token: null
      }
    },
    methods: {
        logout() {
            this.$store.dispatch('auth/logout', this.user)
        },
        getToken() {
            this.token = localStorage.getItem("x-token")
      }
    }
}
</script>



<style scoped lang="scss">

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 10px;
    padding-bottom: 10px;
}

.logo {
    height: 65px;
    margin-left: 85px;
}

.user-nav {
    align-self: stretch;
    display: flex;
    align-items: center;
    & > * {
        padding: 0 2rem;
        cursor: pointer;
        height: 100%;
        display: flex;
        align-items: center;
    }
    &__user-photo {
        height: 50px;
        margin-left: 3rem;
        padding: 0 2rem;
    }
    
    &__user-name {
        padding: 0 3px;
        text-decoration: none;
        color: var(--color-grey-light-4)
    }
    
}

.user-nav-input {
    width: 400px;
}

</style>