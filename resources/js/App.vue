<template>
    <!-- don't use main tag anywhere else -->
    <main>
        <router-view />
    </main>
    <sidebar />
</template>

<script>
import Sidebar from './components/Sidebar.vue'
export default {
    components: { Sidebar },
}
</script>
