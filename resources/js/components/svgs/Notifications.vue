<template>
    <svg xmlns="http://www.w3.org/2000/svg" width="17" height="19" fill="none">
        <path :stroke="active ? '#F6C449' : '#000'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9.942 16.833a1.667 1.667 0 0 1-2.884 0M13.5 6a5 5 0 0 0-10 0c0 5.833-2.5 7.5-2.5 7.5h15s-2.5-1.667-2.5-7.5Z" />
    </svg>
</template>

<script>
export default {
    name: '',
    props: {
        active: {
            type: Boolean,
            default: false
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
