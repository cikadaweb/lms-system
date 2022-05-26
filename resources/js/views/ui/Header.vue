<template>

    <header class="header">
        <router-link :to="'/'"><img src="../../../img/logo.png" class="logo" alt="fsk logo"></router-link>
        <h5>Добро пожаловать на платформу, {{ authUser.role }} !</h5>
        <nav class="user-nav">
            <div class="user-nav__user">

                <!-- <form class="d-flex pe-3">
                    <input class="form-control me-2 user-nav-input" type="search" placeholder="Найти на странице" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Поиск</button>
                </form> -->

                <!-- <img src="../../../img/user.png" alt="User Photo" class="user-nav__user-photo"> -->



                 <ul class="navbar-nav pe-3">
                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
                        role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="../../../img/user3.png" class="rounded-circle"
                            height="33" alt="Avatar" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item" href="#">Мой профиль</a>
                            </li>
                        <li>
                            <a class="dropdown-item" href="#">Настройки</a>
                        </li>
                            <li>
                                <a class="dropdown-item" href="#">Выход</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                
                <my-button v-if="!token" class="btn-danger" type="submit" @click.prevent="logout">Выход</my-button>
                
            </div>
        </nav>
    </header>

</template>



<script>

export default { 
    data() {
      return {
        token: null,
        user: {}
      }
    },
    mounted() {

    },
    methods: {
        logout() {
            this.$store.dispatch('auth/logout', this.user)
            // localStorage.removeItem('userInfo')
        },
    },
    computed: {
        authUser() {
            return this.$store.state.auth.authUser
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