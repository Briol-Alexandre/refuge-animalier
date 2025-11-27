<template>
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="21" fill="none">
        <path
            :stroke="active ? '#F6C449' : '#000'" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
              d="M20.541 2.862a5.5 5.5 0 0 0-7.78 0l-1.06 1.06-1.06-1.06a5.501 5.501 0 0 0-7.78 7.78l8.84 8.84 8.84-8.84a5.5 5.5 0 0 0 0-7.78Z" />
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
