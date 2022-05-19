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
            <router-link :to="'/articles/dashboard'">
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
            <router-link :to="'/courses/dashboard'">
                <li class="side-nav__item">
                    <a href="#" class="side-nav__link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-mortarboard-fill side-nav__link-icon" viewBox="0 0 16 16">
                        <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917l-7.5-3.5Z"/>
                        <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466 4.176 9.032Z"/>
                        </svg>
                        <span>Курсы</span>
                    </a>
                </li>
            </router-link> 
            <router-link :to="'/users/dashboard'">
                <li class="side-nav__item">
                    <a href="#" class="side-nav__link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill side-nav__link-icon" viewBox="0 0 16 16">
                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
                        </svg>
                        <span>Сотрудники</span>
                    </a>
                </li>
            </router-link> 
            <!-- <router-link :to="'/user/management'">
                <li class="side-nav__item">
                    <a href="#" class="side-nav__link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill side-nav__link-icon" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                        <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        <span>Менеджер ролей</span>
                    </a>
                </li>
            </router-link> 
            <router-link :to="'/user/permissions'">
                <li class="side-nav__item">
                    <a href="#" class="side-nav__link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-fill-check side-nav__link-icon" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm2.146 5.146a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647z"/>
                        </svg>
                        <span>Разрешения</span>
                    </a>
                </li>
            </router-link> -->
        </ul>
        <div class="legal">
            &copy; 2022. Формула Стекла.
        </div>
    </nav>
</template>

<script>
export default {
    name: "Sidebar",

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