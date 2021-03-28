<template>
    <div class="create-movie" @click.stop>
        <div class="title">Create</div>
        <form @submit.prevent="create">
            <div class="textfield">
                <label>Name</label>
                <input type="text" v-model="name" />
            </div>
            <div class="textfield">
                <label>Code</label>
                <input type="text" v-model="code" />
            </div>
            <div class="textfield">
                <label>Origin</label>
                <input type="text" v-model="origin" />
            </div>
            <div class="textfield">
                <label>Note</label>
                <textarea v-model="note"></textarea>
            </div>

            <!-- Select boxes -->
            <!-- studio | single -->
            <div class="select">
                <label>Studio</label>
                <select-box
                    :options="studios"
                    @select="setSelectedStudio"
                    :selected="selectedStudio"
                    placeholder="Select studio"
                />
            </div>

            <!-- stars | multi -->
            <div class="select">
                <label>Stars</label>
                <select-box
                    :options="stars"
                    @select="addSelectedStar"
                    :selected="selectedStars"
                    placeholder="Select stars"
                    :multi="true"
                    @deselect="removeStar"
                />
            </div>

            <!-- tags | multi -->
            <div class="select">
                <label>Tags</label>
                <select-box
                    :options="tags"
                    @select="addSelectedTag"
                    :selected="selectedTags"
                    placeholder="Select stars"
                    :multi="true"
                    @deselect="removeTag"
                />
            </div>

            <div class="checkbox">
                <label>
                    Mark as Favorite
                    <input type="checkbox" v-model="favorite" />
                    <div class="box"></div>
                </label>
            </div>

            <button class="btn">Okay</button>
        </form>
    </div>
</template>

<script>
import { ROOT_PATH } from '../common'
import SelectBox from '../components/SelectBox.vue'
export default {
    components: { SelectBox },
    mounted() {
        //  should probably do this lzily inside select component but oh, well

        fetch(ROOT_PATH + '/api/studios?movie=1') // where movie == true
            .then((res) => res.json())
            .then((json) => (this.studios = json.data))
            .catch((err) => console.error(err))

        fetch(ROOT_PATH + '/api/stars')
            .then((res) => res.json())
            .then((json) => (this.stars = json.data))
            .catch((err) => console.error(err))

        fetch(ROOT_PATH + '/api/tags')
            .then((res) => res.json())
            .then((json) => (this.tags = json.data))
            .catch((err) => console.error(err))
    },
    data() {
        return {
            name: '',
            code: '',
            origin: '',
            note: '',
            favorite: false,

            studios: [],
            stars: [],
            tags: [],
            selectedStudio: {},
            selectedStars: [],
            selectedTags: [],

            errors: {},
        }
    },
    methods: {
        setSelectedStudio(selection) {
            this.selectedStudio = selection
        },
        addSelectedStar(selection) {
            if (!this.selectedStars.find((item) => item.id === selection.id))
                this.selectedStars.push(selection)
        },
        removeStar(id) {
            this.selectedStars = this.selectedStars.filter(
                (item) => item.id !== id
            )
        },
        removeTag(id) {
            this.selectedTags = this.selectedTags.filter(
                (item) => item.id !== id
            )
        },
        addSelectedTag(selection) {
            if (!this.selectedTags.find((item) => item.id === selection.id))
                this.selectedTags.push(selection)
        },
        create() {
            // ? validation

            fetch(ROOT_PATH + '/api/movies', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                },
                body: JSON.stringify({
                    name: this.name,
                    code: this.code,
                    origin: this.origin,
                    note: this.note,
                    favorite: this.favorite,
                    studio_id: this.selectedStudio.id,
                    stars: this.selectedStars.map((item) => item.id),
                    tags: this.selectedTags.map((item) => item.id),
                }),
            })
                .then((res) => res.json())
                .then((json) => {
                    // will send error response
                    console.log(json)
                    // go back
                    if (!json.errors) this.$router.push({ name: 'Movies' })
                })
                .catch((err) => console.error(err))
        },
    },
}
</script>
