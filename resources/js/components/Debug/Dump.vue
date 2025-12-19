<template>
    <Teleport to="body">
        <pre class="bg-black text-yellow-500 z-40 absolute w-full h-full top-0 left-0">{{ dumpValue }}</pre>
    </Teleport>
</template>

<script>
export default {
    name: "",
    props: ['dumpValue'],

    data() {
        return {}
    },

    methods: {}
}
</script>

<style>

</style>
