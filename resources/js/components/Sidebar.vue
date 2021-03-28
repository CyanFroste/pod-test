<template>
    <aside class="sidebar">
        <router-link class="logo" :to="{ name: 'Home' }">
            <div>pod</div>
        </router-link>

        <nav class="links">
            <router-link class="link" :to="{ name: 'Movies' }">
                Movies
            </router-link>
            <router-link class="link" :to="{ name: 'Movies' }">
                Hentai
            </router-link>
            <router-link class="link" :to="{ name: 'Movies' }">
                Studios
            </router-link>
            <router-link class="link" :to="{ name: 'Movies' }">
                Artists
            </router-link>
            <router-link class="link" :to="{ name: 'Movies' }">
                Stars
            </router-link>
            <router-link class="link" :to="{ name: 'Movies' }">
                Tags
            </router-link>
            <!-- <router-link :to="{ name: 'Stars' }"> Movies </router-link>
            <router-link :to="{ name: 'Hentai' }"> Movies </router-link>
            <router-link :to="{ name: 'Studios' }"> Movies </router-link>
            <router-link :to="{ name: 'Artists' }"> Movies </router-link>
            <router-link :to="{ name: 'Tags' }"> Movies </router-link> -->
        </nav>
    </aside>
</template>

<script>
export default {}
</script>
