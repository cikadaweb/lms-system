<template>

    <header class="header">

        <div>
            <router-link :to="'/'"><img src="../../../img/logo.png" class="logo" alt="fsk logo"></router-link>
        </div>      

        <!-- <div>
            <h5 class="d-flex" id="time">Время: {{ getTime }}</h5>
        </div>   -->

        <div>
            <h5 class="d-flex">Добро пожаловать на платформу, {{ authUser.name }} !</h5>
        </div>  

        <nav class="navbar navbar-expand-lg user-menu">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../../../img/user3.png" class="rounded-circle" height="33" alt="Avatar" loading="lazy" />
                        </a>
                
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Мой профиль</a></li>
                            <li><a class="dropdown-item" href="#">Настройки</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="" @click.prevent="logout">Выход</a></li>
                        </ul>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
                

    </header>

</template>



<script>

export default { 
    data() {
      return {
        token: null,
        user: {},
        time: ""
      }
    },
    mounted() {
        // this.time = document.getElementById("time");
        // this.tiktak()
    },
    methods: {
        logout() {
            this.$store.dispatch('auth/logout', this.user)
            // localStorage.removeItem('userInfo')
        },
        tiktak() {
            let now = new Date();
            let month = now.getMonth() - 1;
            let day = now.getDay();
            let myHours = now.getHours();
            let myMinutes = now.getMinutes();
            let mySec = now.getSeconds();
            if (myMinutes < 10) myMinutes = "0" + myMinutes;
            if (mySec < 10) mySec = "0" + mySec;

            // let info = `MOSCOW, ${days[day]}, ${
            // months[month]
            // } ${now.getDate()}, ${now.getFullYear()}`;
            // elm1.innerHTML = info;
            this.time.innerHTML = "Текущее время: " + myHours + ":" + myMinutes + ":" + mySec;
            setTimeout(this.tiktak, 1000);
        }
    },
    computed: {
        authUser() {
            return this.$store.state.auth.authUser
        },
        getTime() {
            return this.time
        }
    },
    watch: {
        time(value) {
            console.log(value)
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
    height: 80px;
    margin-left: 85px;
}

.user-menu {
    margin-right: 85px;
}

</style>