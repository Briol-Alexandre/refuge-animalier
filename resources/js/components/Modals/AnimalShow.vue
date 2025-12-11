<template>
    <div class="grid grid-cols-3 gap-2">
        <img :src="animal.image" :alt="`Photo de ${animal.name}`" class="w-full h-full object-cover mt-2" />
        <div class="col-span-2">
            <div class="mb-2 flex gap-4 items-center">
                <h2 class="text-2xl font-atten font-black">{{ animal.name }}</h2>
                <span class="text-sm">{{ animal.status }}</span>
            </div>
            <dl class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <dt class="font-bold">Âge&nbsp;:</dt>
                    <dd>{{ calculateAge(animal.age) }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Espèce&nbsp;:</dt>
                    <dd>{{ animal.specie.name }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Race&nbsp;:</dt>
                    <dd>{{ animal.breed.name }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Sexe&nbsp;:</dt>
                    <dd>{{ animal.sexe }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Pelage&nbsp;:</dt>
                    <dd class="flex flex-col">
                        <ul class="list-disc list-inside">
                            <li v-for="coat in animal.coat">
                                {{ coat.name }}
                            </li>
                        </ul>
                    </dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Vaccins&nbsp;:</dt>
                    <dd>À jour</dd>
                </div>
            </dl>
            <div class="mt-2">
                <p class="font-bold">Notes</p>
                <ul class="list-disc list-inside">
                    <li><a href="">Note</a></li>
                    <li><a href="">Note</a></li>
                    <li><a href="">Note</a></li>
                    <li><a href="">Note</a></li>
                </ul>
            </div>
        </div>
        <div class="col-span-full">
            <p class="font-bold">Description</p>
            <p>
                {{ animal.desc }}
            </p>
        </div>
        <div class="mx-auto col-span-full flex gap-4">
            <button class="button-dark" @click="handleChangeStatusModal">
                Changer le statut de l'animal
            </button>
            <button class="button-light" @click="openEditModal">
                Modifier la fiche
            </button>
            <!-- TODO: MAKE THIS BUTTON ONLY ACCESSIBLE TO THE ADMIN -->
            <button class="button-light" @click="handleDeleteModal">
                Supprimer la fiche
            </button>
        </div>
    </div>
    <Teleport to="body">
        <Modal
            @close="handleDeleteModal"
            :condition="isDeleteModalOpen"
            index="z-30"
            modal-classes="w-fit"
            close-btn-classes="!top-5 !right-5"
        >
            <p>Voulez-vous vraiment supprimer : </p>
            <p class="font-bold">{{ this.animal?.name }}</p>
            <div class="flex justify-between gap-2 mt-6">
                <button class="underline hover:cursor-pointer" @click="handleArchiveModal">Annuler</button>
                <button class="text-red-600 underline hover:cursor-pointer" @click="handleDelete">
                    Supprimer
                </button>
            </div>
        </Modal>
        <Modal
            @close="handleArchiveModal"
            :condition="isArchiveModalOpen"
            index="z-30"
            modal-classes="w-fit"
            close-btn-classes="!top-5 !right-5"
        >
            <p>Voulez-vous vraiment archiver : </p>
            <p class="font-bold">{{ this.animal?.name }}</p>
            <div class="flex justify-between gap-2 mt-6">
                <button class="underline hover:cursor-pointer" @click="handleArchiveModal">Annuler</button>
                <button class="text-red-600 underline hover:cursor-pointer" @click="updateAnimalStatus(animal)">
                    Archiver
                </button>
            </div>
        </Modal>
        <Modal
            @close="handleChangeStatusModal"
            :condition="isChangeStatusModalOpen"
            index="z-30"
            modal-classes="max-w-[700px]"
        >
            <form class="flex flex-col gap-2" @submit.prevent="updateAnimalStatus(animal)">
                <p class="title !mb-0">Changer le statut de : {{ this.animal.name }}</p>

                <Select id-name="status" label="Statut de l'animal" v-model="statusAnimal.status">
                    <option value="">--Choisir un status--</option>
                    <option v-for="status in statusList" :value="status">{{ status }}</option>
                </Select>
                <InputError :message="statusAnimal.errors.status" />
                <button type="submit" class="button-light ml-auto">Changer</button>
            </form>
        </Modal>
        <Modal :condition="isModalOpen" @close="openEditModal" index="z-30" modal-classes="">
            <AnimalEditForm :open-modal="openEditModal" :species="species" :breeds="breeds" :coats="coats"
                              :vaccines="vaccines" :animal="animal" @updated="$emit('updated');openEditModal"/>
        </Modal>
    </Teleport>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import { useStatusStore } from '@/stores/statusStore.js';
import { updateStatus } from '@/actions/App/Http/Controllers/AnimalsController';
import { destroy } from '@/actions/App/Http/Controllers/AnimalsController';
import { useToasterStore } from '@/stores/useToasterStore.js';
import Modal from '@/components/widget/Modal.vue';
import { Button } from '@/components/ui/button/index.js';
import Select from '@/components/widget/form/Select.vue';
import InputError from '@/components/InputError.vue';
import AnimalCreateForm from '@/components/widget/form/AnimalCreateForm.vue';
import AnimalEditForm from '@/components/widget/form/AnimalEditForm.vue';

export default {
    props: ['animal', 'coats', 'breeds', 'species', 'status', 'vaccines'],

    components: {
        AnimalCreateForm,
        InputError,
        Button,
        Modal,
        Select,
        AnimalEditForm
    },

    data() {
        return {
            toast: useToasterStore(),
            statusList: useStatusStore().statusList,
            isArchiveModalOpen: false,
            isChangeStatusModalOpen: false,
            isVaccineModalOpen: false,
            statusAnimal: useForm({
                'status': null
            }),
            deleteForm: useForm({
                'id': this.animal.id,
            }),
            isModalOpen: false,
            isDeleteModalOpen: false,
        };
    },

    methods: {
        updateStatus,
        destroy,
        calculateAge(date) {
            const animalBirth = new Date(date);
            const today = new Date();

            let age = today.getFullYear() - animalBirth.getFullYear();

            if (age <= 0) {
                age = '';
            } else if (age === 1) {
                age = age + ' an';
            } else {
                age = age + ' ans';
            }

            let month = today.getMonth() - animalBirth.getMonth();

            if (month <= 1) {
                month = 'Moins d‘un mois';
            } else {
                month = month + ' mois';
            }
            return `${age}  ${month}`;
        },
        handleArchiveModal() {
            this.isArchiveModalOpen = !this.isArchiveModalOpen;
        },
        openEditModal() {
            this.isModalOpen = !this.isModalOpen;
        },
        handleChangeStatusModal() {
            this.isChangeStatusModalOpen = !this.isChangeStatusModalOpen;
        },
        updateAnimalStatus() {
            this.statusAnimal.put(updateStatus(this.animal.id), {
                onSuccess: () => {
                    this.animal.status = this.statusAnimal.status;
                    this.toast.success({ text: 'Statut mis à jour avec succès !' });
                    this.isArchiveModalOpen = false;
                    this.isChangeStatusModalOpen = false;
                }
            });
        },
        handleDeleteModal () {
            this.isDeleteModalOpen = !this.isDeleteModalOpen;
        },

        handleDelete() {
            this.deleteForm.delete(destroy(this.animal.id), {
                onSuccess: () => {
                    this.toast.success({ text: 'Animal supprimé avec succès !' });
                    this.$emit('deleted');
                },
                onError: ()=>{
                    this.toast.error({ text: 'Une erreur s‘est produite lors de la manipulation'});
                }
            })
        }


    }

};
</script>
