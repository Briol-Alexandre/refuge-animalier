<template>
    <LoggedLayout title="Animaux">
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
                :fields="['image', 'name', 'specie', 'status']"
                @row-click="openShowModal">
                <template v-slot:filters>
                    <div class="grid grid-cols-2 gap-x-4 gap-y-2">
                        <p class="title col-span-full !mb-0">
                            Filtres
                        </p>
                        <Select v-model="specie" id-name="specie" label="Type d‘animal" @change="addElModal">
                            <option value="">--Choisir une espèce--</option>
                            <option value="dog">Chien</option>
                            <option value="cat">Chat</option>
                        </Select>

                        <Select v-model="breed" id-name="breed" label="Race de l‘animal" @change="addElModal">
                            <option value="">--Choisir une race--</option>
                            <option value="golden">Golden</option>
                            <option value="chihuahua">Chihuahua</option>
                        </Select>

                        <Select v-model="coat" id-name="coat" label="Pelage de l‘animal" @change="addElModal">
                            <option value="">--Choisir un pelage--</option>
                            <option value="golden">Noir</option>
                            <option value="chihuahua">Blanc</option>
                        </Select>

                        <InputLabel id-name="date" type="date" placeholder="DD/MM/AAAA">
                            Date de naissance de l'animal
                        </InputLabel>

                        <Select id-name="sexe" label="Sexe de l‘animal">
                            <option value="">--Choisir un sexe--</option>
                            <option value="male">Mâle</option>
                            <option value="female">Femelle</option>
                        </Select>

                        <Select v-model="vaccine" id-name="vaccine" label="Vaccins" @change="addElModal">
                            <option value="">--Choisir une option--</option>
                            <option value="uptodate">À jour</option>
                            <option value="todo">À faire</option>
                        </Select>

                        <Select v-model="animalStatus" id-name="status" label="Statut" @change="addElModal">
                            <option value="">--Choisir un statut--</option>
                            <option value="available">Disponible</option>
                            <option value="cure">En soins</option>
                        </Select>
                        <div class="flex items-center col-span-full justify-end gap-4">
                            <button>
                                Réinitialiser
                            </button>
                            <button class="button-light mb-0">
                                Appliquer
                            </button>
                        </div>
                    </div>
                </template>

                <Modal :condition="isShowModalOpen" @close="toggleShowModal" index="z-30">
                    <AnimalShow :animal="selectedRow" />
                </Modal>

            </TableContainer>

            <Teleport to="body">
                <Modal :condition="isModalOpen" @close="openCreateModal" index="z-30">
                    <AnimalCreateForm :open-modal="openCreateModal" />
                </Modal>
            </Teleport>
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
import Modal from '@/components/widget/Modal.vue';
import AnimalCreateForm from '@/components/widget/form/AnimalCreateForm.vue';
import AnimalShow from '@/components/Modals/AnimalShow.vue';
import InputLabel from '@/components/widget/form/InputLabel.vue';
import Select from '@/components/widget/form/Select.vue';
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
        TableContainer
    },
    props: ['animals'],

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
