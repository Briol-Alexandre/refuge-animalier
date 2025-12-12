<template>
        <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
            <div class="mt-14 mb-14 col-start-2 col-span-8 row-start-1 flex justify-between items-center">
                <h1 class="title !mb-0">
                    Liste des animaux
                </h1>
                <button class="button-light z-10" @click="openCreateModal">
                    Ajouter un animal
                </button>
            </div>
            <TableContainer
                :paginationLinks="animals.links"
                :rows="animals.data"
                :cols="['Image', 'Nom', 'Espèce', 'Statut']"
                :fields="['images', 'name', 'breed', 'status']"
                @row-click="openShowModal">
                <template v-slot:filters>
                    <AnimalsFilter :species="species" :breeds="breeds" :coats="coats" :status="status"/>
                </template>

                <Modal :condition="isShowModalOpen" @close="toggleShowModal" index="z-30">
                    <AnimalShow :animal="selectedRow" :species="species" :breeds="breeds" :coats="coats" :vaccines="vaccines" @updated="toggleShowModal" @deleted="toggleShowModal"/>
                </Modal>

            </TableContainer>

            <Teleport to="body">
                <Modal :condition="isModalOpen" @close="openCreateModal" index="z-30">
                    <AnimalCreateForm :open-modal="openCreateModal" :species="species" :breeds="breeds" :coats="coats" :vaccines="vaccines"/>
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
import InputLabel from '@/components/widget/form/InputLabel.vue';
import Select from '@/components/widget/form/Select.vue';
import AnimalsFilter from '@/components/widget/form/AnimalsFilter.vue';
import { Button } from '@/components/ui/button/index.js';

export default {
    name: '',
    components: {
        Button, Select, InputLabel,
        AnimalShow,
        AnimalCreateForm, Modal,
        StatistiquesContainer,
        InfoCardContainer,
        NotificationContainer,
        LoggedLayout,
        TableComponent,
        Pagination,
        TableContainer,
        AnimalsFilter
    },
    props: ['animals', 'coats', 'breeds', 'species', 'status', 'vaccines', 'title'],

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
            this.isShowModalOpen = true;
        }
    }
};
</script>

<style>

</style>
