<template>
    <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
        <div class="mt-14 mb-14 col-start-2 col-span-8 row-start-1 flex justify-between items-center">
            <h1 class="title !mb-0">
                {{ title }}
            </h1>
            <button class="button-light z-10" @click="openCreateModal">
                Ajouter une adoption
            </button>
        </div>
        <TableContainer
            :paginationLinks="adoptions.links"
            :rows="formattedAdoptions"
            :cols="['Nom de l‘adoptant', 'Nom de l‘animal', 'Date de l‘adoption', 'Statut']"
            :fields="['adopter_name', 'animal_name', 'adoption_date', 'status']"
            :filters="this.filters"
            @row-click="openShowModal">

            <template v-slot:filters>
                <KeepAlive>
                    <AdoptionsFilter :status="status" @filterChange="filterTable" :modelValue="currentFilterValue" />
                </KeepAlive>
            </template>

            <Modal :condition="isShowModalOpen" @close="toggleShowModal" index="z-30">
                <AdoptionShow :adoption="selectedRow" :animal="getAnimal(selectedRow.animal_id)"
                              :adopter="getAdopter(selectedRow.adopter_id)" :animals="animals" :adopters="adopters"
                              :status="status" :adoptions="adoptions" @updated="toggleShowModal" :is-admin="isAdmin" />
            </Modal>

        </TableContainer>

        <Teleport to="body">
            <Modal :condition="isModalOpen" @close="openCreateModal" index="z-30">
                <AdoptionCreateForm :open-modal="openCreateModal" :animals="animals" :adopters="adopters"
                                    :status="status" @created="openCreateModal" :is-admin="isAdmin"/>
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
    props: ['adoptions', 'title', 'animals', 'adopters', 'status', 'isAdmin'],

    data() {
        return {
            isModalOpen: false,
            isShowModalOpen: false,
            selectedRow: null,
            filters: [],
            currentFilterValue: ''
        };
    },

    computed: {
        formattedAdoptions() {
            return this.adoptions.data.map(adoption => ({
                ...adoption,
                animal_name: this.getAnimal(adoption.animal_id)?.name || 'N/A',
                adopter_name: this.getAdopter(adoption.adopter_id)?.name || 'N/A',
                status: this.getStatusLabel(adoption.status)
            }));
        }
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
        },
        getAnimal(animalId) {
            return this.animals.find(animal => animal.id === animalId);
        },
        getAdopter(adopterId) {
            return this.adopters.find(adopter => adopter.id === adopterId);
        },
        getStatusLabel(statusValue) {
            const statusObj = this.status.find(s => s.value === statusValue);
            return statusObj ? statusObj.label : statusValue;
        },
        filterTable(filter) {
            this.currentFilterValue = filter;
            this.filters = {
                'status': filter
            };
        }
    }
};
</script>

<style>

</style>
