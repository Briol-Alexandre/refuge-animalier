<template>
    <LoggedLayout title="Dashboard">
        <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
            <h1 class="title mt-14 col-start-2 col-span-full row-start-1">
                Bienvenue {{ $page.props.auth.user.name }}
            </h1>
            <InfoCardContainer />
            <NotificationContainer />
            <StatistiquesContainer/>
        </div>
    </LoggedLayout>
</template>


<script>
import LoggedLayout from '@/layouts/LoggedLayout.vue';
import InfoCardContainer from '@/components/widget/dashboard-page/InfoCardContainer.vue';
import NotificationContainer from '@/components/widget/dashboard-page/NotificationContainer.vue';
import StatistiquesContainer from '@/components/widget/dashboard-page/StatistiquesContainer.vue';
import Statistiques from '@/components/svgs/Statistiques.vue';
import Download from '@/components/svgs/Download.vue';
import { router } from '@inertiajs/vue3';
import { show } from '@/actions/App/Http/Controllers/StatistiquesController'

export default {

    name: '',
    methods: {
        router() {
            return router
        }
    },
    components: {
        LoggedLayout,
        InfoCardContainer,
        NotificationContainer,
        StatistiquesContainer,
        Statistiques,
        Download
    },
    props: [],
    computed: {
        show() {
            return show
        }
    },
    data() {
        return {};
    },
};
</script>

<style>

</style>
