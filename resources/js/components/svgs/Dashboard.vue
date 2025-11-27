<template>
    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 22 22">
        <path
            :stroke="active ? '#F6C449' : '#000'"
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M9 1H1v10h8V1Zm12 0h-8v6h8V1Zm0 10h-8v10h8V11ZM9 15H1v6h8v-6Z"
        />
    </svg>
</template>

<script>
export default {
    name: "Dashboard",
    props: {
        active: {
            type: Boolean,
            default: false
        }
    }
}
</script>
