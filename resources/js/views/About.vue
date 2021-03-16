<template>
    <div class="desc">{{ description }}</div>
</template>

<script>
export default {
    name: 'About',
    data() {
        return {
            description: 'This is an example route `/about`',
        }
    },
}
</script>