<template>
    <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
        <div class="mt-14 mb-14 col-start-2 col-span-8 row-start-1 flex justify-between items-center">
            <h1 class="title !mb-0">
                Liste des adoptions
            </h1>
            <button class="button-light z-10" @click="openCreateModal">
                Ajouter une adoption
            </button>
        </div>
        <TableContainer
            :paginationLinks="adoptions.links"
            :rows="adoptions.data"
            :cols="['Nom de l‘adoptant', 'Nom de l‘animal', 'Date de l‘adoption', 'Statut']"
            :fields="['adopter', 'animal', 'adoption_date', 'status']"
            @row-click="openShowModal">

            <template v-slot:filters>
                <AdoptionsFilter />
            </template>

            <Modal :condition="isShowModalOpen" @close="toggleShowModal" index="z-30">
                <AdoptionShow :adoption="selectedRow" />
            </Modal>

        </TableContainer>

        <Teleport to="body">
            <Modal :condition="isModalOpen" @close="openCreateModal" index="z-30">
                <AdoptionCreateForm :open-modal="openCreateModal" />
            </Modal>
        </Teleport>
    </div>
</template>

<script>
import LoggedLayout from '@/layouts/LoggedLayout.vue';
import NotificationContainer from '@/components/widget/dashboard-page/NotificationContainer.vue';
import InfoCardContainer from '@/components/widget/dashboard-page/InfoCardContainer.vue';
import StatistiquesContainer from '@/components/widget/dashboard-page/StatistiquesContainer.vue';
import TableComponent from '@/components/TableComponent.vue';
import Pagination from '@/components/Pagination.vue';
import TableContainer from '@/components/widget/animals-page/TableContainer.vue';
import Modal from '@/components/widget/Modal.vue';
import AnimalCreateForm from '@/components/widget/form/AnimalCreateForm.vue';
import AnimalShow from '@/components/Modals/AnimalShow.vue';
import AdoptionShow from '@/components/Modals/AdoptionShow.vue';
import InputLabel from '@/components/widget/form/InputLabel.vue';
import Select from '@/components/widget/form/Select.vue';
import AdoptionsFilter from '@/components/widget/form/AdoptionsFilter.vue';
import AdoptionCreateForm from '@/components/widget/form/AdpotionCreateForm.vue';
import { Button } from '@/components/ui/button/index.js';

export default {
    name: '',
    components: {
        Button, Select, InputLabel,
        AdoptionShow,
        AnimalShow,
        AnimalCreateForm, Modal,
        StatistiquesContainer,
        InfoCardContainer,
        NotificationContainer,
        LoggedLayout,
        TableComponent,
        Pagination,
        TableContainer,
        AdoptionsFilter,
        AdoptionCreateForm
    },
    props: ['adoptions'],

    data() {
        return {
            isModalOpen: false,
            isShowModalOpen: false,
            selectedRow: null
        };
    },

    methods: {
        openCreateModal() {
            this.isModalOpen = !this.isModalOpen;
        },
        toggleShowModal() {
            this.isShowModalOpen = !this.isShowModalOpen;
        },
        openShowModal(row) {
            this.selectedRow = row;
            console.log(this.selectedRow);
            this.isShowModalOpen = true;
        }
    }
};
</script>

<style>

</style>
