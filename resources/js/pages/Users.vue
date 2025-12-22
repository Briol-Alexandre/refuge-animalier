<template>
    <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
        <div class="mt-14 mb-14 col-start-2 col-span-8 row-start-1 flex justify-between items-center">
            <h1 class="title !mb-0">
                Liste des bénévoles
            </h1>
            <button class="button-light z-10" @click="openCreateModal">
                Ajouter un bénévole
            </button>
        </div>
        <TableContainer
            :paginationLinks="volunteers_link.links"
            :rows="volunteers"
            :cols="['Avatar', 'Nom', 'Email', 'Téléphone', 'Permissions']"
            :fields="['avatar', 'name', 'email', 'tel', 'permissions']"
            @row-click="openShowModal">
            <template v-slot:filters>
                <AnimalsFilter />
            </template>
            <Modal :condition="isShowModalOpen" @close="toggleShowModal" index="z-30">
                <VolunteerShow :volunteer="selectedRow" :schedule="selectedRow.schedule" :permissions="permissions" @updated="toggleShowModal"/>
            </Modal>

        </TableContainer>

        <Teleport to="body">
            <Modal :condition="isModalOpen" @close="openCreateModal" index="z-30">
                <VolunteerCreateForm :open-modal="openCreateModal" :permissions="permissions" @created="openCreateModal"/>
            </Modal>
        </Teleport>
    </div>
</template>

<script>
import LoggedLayout from '@/layouts/LoggedLayout.vue';
import TableContainer from '@/components/widget/animals-page/TableContainer.vue';
import Modal from '@/components/widget/Modal.vue';
import AnimalsFilter from '@/components/widget/form/AnimalsFilter.vue';
import VolunteerCreateForm from '@/components/widget/form/VolunteerCreateForm.vue';
import { Button } from '@/components/ui/button/index.js';
import VolunteerShow from '@/components/Modals/VolunteerShow.vue';

export default {
    name: '',
    components: { VolunteerShow, Button, VolunteerCreateForm, AnimalsFilter, Modal, TableContainer, LoggedLayout },
    props: ['volunteers', 'permissions', 'volunteers_link'],

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
        },
    }
};
</script>

<style>

</style>
