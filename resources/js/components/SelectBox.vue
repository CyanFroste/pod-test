<template>
    <!-- needs array of {name, id} -->
    <div class="select-box">
        <div v-if="!multi" class="selected" @click="showOptions = true">
            {{ selected.name || placeholder }} <span> ▼ </span>
        </div>
        <div v-else class="multi-selected">
            <span v-for="item in selected" :key="item.id">
                <span> {{ item.name }} </span>
                <button type="button" @click="$emit('deselect', item.id)">
                    ✖
                </button>
            </span>
            <button class="add" type="button" @click="showOptions = true">
                +
            </button>
        </div>
        <div
            class="options-modal"
            v-if="showOptions"
            @click="showOptions = false"
        >
            <div class="options" @click.stop>
                <input placeholder="Search" class="search" type="text" />
                <div class="list">
                    <div
                        v-for="option in options"
                        :key="option.id"
                        class="option"
                        @click="onSelect({ name: option.name, id: option.id })"
                    >
                        {{ option.name }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['options', 'placeholder', 'selected', 'multi'],
    data() {
        return {
            showOptions: false,
        }
    },
    methods: {
        onSelect(selection) {
            this.showOptions = false
            this.$emit('select', selection)
        },
    },
}
</script>
