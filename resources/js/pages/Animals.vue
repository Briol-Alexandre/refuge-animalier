<template>
    <LoggedLayout title="Animaux">
        <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
            <h1 class="title mt-14 col-start-2 col-span-full row-start-1">
                Listes des animaux
            </h1>
            <TableContainer :paginationLinks="animals.links" :rows="animals.data" :cols="['Image', 'Nom', 'Espèce', 'Statut']" :fields="['image', 'name', 'specie', 'status']"/>
        </div>
    </LoggedLayout>
</template>

<script>
import LoggedLayout from '@/layouts/LoggedLayout.vue';
import NotificationContainer from '@/components/widget/dashboard-page/NotificationContainer.vue';
import InfoCardContainer from '@/components/widget/dashboard-page/InfoCardContainer.vue';
import StatistiquesContainer from '@/components/widget/dashboard-page/StatistiquesContainer.vue';
import TableComponent from '@/components/TableComponent.vue';
import Pagination from '@/components/Pagination.vue';
import TableContainer from '@/components/widget/animals-page/TableContainer.vue';

export default {
    name: '',
    components: { StatistiquesContainer, InfoCardContainer, NotificationContainer, LoggedLayout, TableComponent, Pagination, TableContainer },
    props: ['animals'],

    data() {
        return {

        };
    },

    methods: {

    }
};
</script>

<style>

</style>
