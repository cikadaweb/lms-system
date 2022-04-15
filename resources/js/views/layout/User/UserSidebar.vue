<template>
    <nav class="sidebar">
        <ul class="side-nav">
           <router-link :to="'/'">
                <li class="side-nav__item">
                    <a href="#" class="side-nav__link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill side-nav__link-icon" viewBox="0 0 16 16">
                            <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z"/>
                        </svg>
                        <span>Главная</span>
                    </a>
                </li>
            </router-link> 
            <router-link :to="'/articles'">
                <li class="side-nav__item">
                    <a href="#" class="side-nav__link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-newspaper side-nav__link-icon" viewBox="0 0 16 16">
                        <path d="M0 2.5A1.5 1.5 0 0 1 1.5 1h11A1.5 1.5 0 0 1 14 2.5v10.528c0 .3-.05.654-.238.972h.738a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 1 1 0v9a1.5 1.5 0 0 1-1.5 1.5H1.497A1.497 1.497 0 0 1 0 13.5v-11zM12 14c.37 0 .654-.211.853-.441.092-.106.147-.279.147-.531V2.5a.5.5 0 0 0-.5-.5h-11a.5.5 0 0 0-.5.5v11c0 .278.223.5.497.5H12z"/>
                        <path d="M2 3h10v2H2V3zm0 3h4v3H2V6zm0 4h4v1H2v-1zm0 2h4v1H2v-1zm5-6h2v1H7V6zm3 0h2v1h-2V6zM7 8h2v1H7V8zm3 0h2v1h-2V8zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1zm-3 2h2v1H7v-1zm3 0h2v1h-2v-1z"/>
                        </svg>
                        <span>Объявления</span>
                    </a>
                </li>
            </router-link> 

 

        </ul>
        <div class="legal">
            &copy; 2022. Формула Стекла. All right reserved.
        </div>
    </nav>
</template>

<script>
export default {
    
}
</script>

<style scoped lang="scss">

a {
    text-decoration: none;
}

.sidebar {
    // background-color: #F5EFFF;
    border-radius: 15px;
    flex: 0 0 18%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: 98%;
}
.side-nav {
    font-size: 16px;
    list-style: none;
    margin-top: 3.5rem;
    text-decoration: none;
    &__item {
        display: flex;
        justify-content: space-between;
        text-decoration: none;
    }
    &__link:link,
    &__link:visited
    {
        color: black;
        text-decoration: none;
        padding: 1.75rem 3rem;
        display: flex;
        justify-content: space-between;
    }
    &__link:hover {
        color: cornflowerblue;
    }
}
.legal {
    font-size: 16px;
    text-align: center; 
    padding: 2.5rem;
}

.side-nav__link-icon {
    width: 25px;
    height: 25px;
    margin-right: 15px;
}
</style>