<script>
import { Head, Link } from '@inertiajs/vue3';
import Heading from '@/components/Heading.vue';
import Logo from '@/components/svgs/Logo.vue';
import Dashboard from '@/components/svgs/Dashboard.vue';
import Paw from '@/components/svgs/Paw.vue';
import LoggedLayout from '@/layouts/LoggedLayout.vue';
export default {

    name: '',
    components: { LoggedLayout, Dashboard, Link, Logo, Heading, Head, Paw },
    props: [],
    computed: {
    },
    data() {
        return {};
    },

    methods: {}
};
</script>

<template>
    <LoggedLayout title="Dashboard">
        <h1>Dashboard</h1>
    </LoggedLayout>
</template>

<style>

</style>
