<template>
    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="21" fill="none">
        <path :stroke="color ?? (active ? '#F6C449' : '#000')" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="M17.25 19.25v-2a4 4 0 0 0-4-4h-8a4 4 0 0 0-4 4v2m12-14a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" />
    </svg>
</template>

<script>
export default {
    name: '',
    props: {
        active: {
            type: Boolean,
            default: false
        },
        color:{
            type: String,
            default: null
        }
    },

    data() {
        return {};
    },

    methods: {}
};
</script>

<style>

</style>
