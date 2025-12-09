<template>
    <svg xmlns="http://www.w3.org/2000/svg" width="21" height="23" fill="none" viewBox="0 0 21 23">
        <path :stroke="active ? '#F6C449' : '#000'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="M19.25 4.25c0 1.66-4.03 3-9 3s-9-1.34-9-3m18 0c0-1.66-4.03-3-9-3s-9 1.34-9 3m18 0v14c0 1.66-4 3-9 3s-9-1.34-9-3v-14m18 7c0 1.66-4 3-9 3s-9-1.34-9-3"/>
    </svg>

</template>

<script>
export default {
    name: "",
    props: {
        active: {
            type: Boolean,
            default: false
        }
    },

    data() {
        return {}
    },

    methods: {}
}
</script>

<style>

</style>
