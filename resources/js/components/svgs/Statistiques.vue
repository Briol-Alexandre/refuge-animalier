<template>
    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="22" fill="none">
        <path :fill="active ? '#F6C449' : '#000'"
              d="M4.333 11.917V4.144l-2.79 2.79L0 5.416 5.417 0l5.416 5.417L9.29 6.933 6.5 4.143v7.774H4.333Zm7.584 9.75L6.5 16.25l1.544-1.517 2.79 2.79V9.75H13v7.773l2.79-2.79 1.543 1.517-5.416 5.417Z" />
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
