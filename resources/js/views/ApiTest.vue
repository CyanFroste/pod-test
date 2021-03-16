<template>
    {{ JSON.stringify(data) }}
</template>

<script>
import { ROOT_PATH } from '../common'
export default {
    data() {
        return {
            data: null,
        }
    },
    mounted() {
        fetch(ROOT_PATH + '/api/test')
            .then((res) => res.json())
            .then((data) => (this.data = data))
            .catch((err) => console.error(err))
    },
}
</script>
