<template>
    <LoggedLayout title="Dashboard">
        <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
            <h1 class="title mt-14 col-start-2 col-span-full row-start-1">
                Bienvenue {{ $page.props.auth.user.name }}
            </h1>
            <InfoCardContainer />
            <NotificationContainer/>
        </div>
    </LoggedLayout>
</template>


<script>
import LoggedLayout from '@/layouts/LoggedLayout.vue';
import InfoCardContainer from '@/components/widget/dashboard-page/InfoCardContainer.vue';
import NotificationContainer from '@/components/widget/dashboard-page/NotificationContainer.vue';

export default {

    name: '',
    components: {
        LoggedLayout,
        InfoCardContainer,
        NotificationContainer,
    },
    props: [],
    computed: {},
    data() {
        return {};
    },

    methods: {}
};
</script>

<style>

</style>
