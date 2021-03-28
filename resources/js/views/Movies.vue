<template>
    <section class="movies">
        <div class="controls">
            <div class="title">Movies</div>
            <router-link :to="{ name: 'CreateMovie' }" class="btn">
                Add
            </router-link>
            <!-- <input type="text" placeholder="Search" /> -->
            <!-- <button type="button" class="btn">Favorites</button> -->
        </div>

        <div class="grid-view">
            <div class="card" v-for="movie in movies" :key="movie.id">
                <div v-if="movie.name" class="name">{{ movie.name }}</div>
                <div class="code" v-if="movie.code">{{ movie.code }}</div>

                <div v-if="movie.stars.length" class="stars">
                    <router-link
                        to="/"
                        v-for="star in movie.stars"
                        :key="star.id"
                    >
                        @{{ star.name }}
                    </router-link>
                </div>

                <div v-if="movie.note" class="note">{{ movie.note }}</div>
                <div v-if="movie.studio" class="creator">
                    {{ movie.studio.name }} • {{ movie.origin }}
                </div>

                <!-- show top tags only -->
                <div v-if="movie.tags.length" class="tags">
                    <span v-for="tag in movie.tags" :key="tag.id">
                        {{ tag.name }}
                    </span>
                </div>

                <!-- <div v-for="(val, key) in JSON.parse(movie.extra)" :key="key">
                    {{ key }} : {{ val }}
                </div> -->

                <!-- later on overhaul the favorite card with black bg and golden accents -->
                <div class="actions">
                    <button
                        type="button"
                        class="favorite"
                        :class="movie.favorite && 'active'"
                    >
                        ❤
                    </button>
                    <button type="button" class="btn-ghost">edit</button>
                    <button
                        type="button"
                        class="btn-ghost"
                        @click="deleteMovie(movie.id)"
                    >
                        delete
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section
        class="create-movie-container"
        v-if="showCreateMovieModal"
        @click="$router.push({ name: 'Movies' })"
    >
        <router-view></router-view>
    </section>
</template>

<script>
import { ROOT_PATH } from '../common'
export default {
    name: 'Movies',
    components: {},
    mounted() {
        fetch(ROOT_PATH + '/api/movies')
            .then((res) => res.json())
            .then((json) => (this.movies = json.data))
            .catch((err) => console.error(err))

        // v-for="idx in Array.from(Array(100).keys())"
        // :key="idx"
    },
    updated() {
        // this is a bad idea, probably
        // TODO: implement SWR using composition API https://blog.logrocket.com/advanced-data-fetching-techniques-in-vue/
        fetch(ROOT_PATH + '/api/movies')
            .then((res) => res.json())
            .then((json) => (this.movies = json.data))
            .catch((err) => console.error(err))
    },
    watch: {
        $route: {
            immediate: true,
            handler(_new, _old) {
                this.showCreateMovieModal = _new.meta.show
            },
        },
    },
    data() {
        return {
            movies: [],
            showCreateMovieModal: false,
        }
    },
    methods: {
        deleteMovie(id) {
            fetch(ROOT_PATH + '/api/movies/' + id, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                },
            })
                .then((res) => res.status)
                .then((status) => {
                    if (status === 204) console.log(status)
                    // this.movies = this.movies.filter(
                    //     (item) => item.id !== id
                    // )
                })
                .catch((err) => console.error(err))
        },
    },
}
</script>
