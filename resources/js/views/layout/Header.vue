<template>

    <header class="header">
        <img src="../../../img/logo.png" class="logo" alt="fsk logo">
        <nav class="user-nav">
            <div class="user-nav__user">
                <!-- <img src="../../../img/user.png" alt="User Photo" class="user-nav__user-photo"> -->
                <router-link :to="'/user/register'"><span class="user-nav__user-name">Registration</span></router-link>
                <router-link :to="'/user/login'"><span class="user-nav__user-name">Login</span></router-link>
                
            </div>
        </nav>
    </header>

</template>



<script>

export default {

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
    margin-left: 120px;
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

</style>