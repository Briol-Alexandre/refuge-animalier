<template>
    <LoggedLayout title="Dashboard">
        <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
            <h1 class="title mt-14 col-start-2 col-span-full row-start-1">
                Bienvenue {{ $page.props.auth.user.name }}
            </h1>
            <InfoCardContainer :datas="datas" />
            <NotificationContainer :notifications="notifications" :urgents="urgents"/>
            <StatistiquesContainer />
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
import { show } from '@/actions/App/Http/Controllers/StatistiquesController';
import Hearth from '@/components/svgs/Hearth.vue';
import Paw from '@/components/svgs/Paw.vue';

export default {

    name: '',
    methods: {},
    components: {
        Hearth,
        Paw,
        LoggedLayout,
        InfoCardContainer,
        NotificationContainer,
        StatistiquesContainer,
        Statistiques,
        Download
    },
    props: ['animals', 'available','adoptions', 'volunteers', 'cures', 'notifications', 'urgents'],
    computed: {
        show() {
            return show;
        }
    },
    data() {
        return {
            datas: [
                {
                    model: this.adoptions,
                    color: 'text-main-red',
                    colorOpacity : 'bg-main-red-opacity',
                    title:'Animaux adoptés',
                    gridPos: 'col-start-2 col-end-4 row-start-2 row-span-1',
                    svg: 'hearth',
                },
                {
                    model: this.available,
                    color: 'text-main-yellow',
                    colorOpacity : 'bg-main-yellow-opacity',
                    title:'Animaux disponibles',
                    gridPos: 'col-start-4 col-end-6 row-start-2 row-span-1',
                    svg: 'paw',
                },
                {
                    model: this.volunteers,
                    color: 'text-main-green',
                    colorOpacity : 'bg-main-green-opacity',
                    title:'Bénévoles',
                    gridPos: 'col-start-6 col-end-8 row-start-2 row-span-1',
                    svg: 'user',
                },
                {
                    model: this.animals,
                    color: 'text-main-blue',
                    colorOpacity : 'bg-main-blue-opacity',
                    title:'Animaux recueillis',
                    gridPos: 'col-start-8 col-end-10 row-start-2 row-span-',
                    svg: 'hand',
                },
                {
                    model: this.cures,
                    color: 'text-main-lightBlue',
                    colorOpacity : 'bg-main-lightBlue-opacity',
                    title:'Animaux en soin',
                    gridPos: 'col-start-8 col-end-10 row-start-3 row-span-1',
                    svg: 'vaccine',
                },
            ]
        };
    }
};
</script>

<style>

</style>
