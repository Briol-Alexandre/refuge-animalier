<template>
    <div class="grid grid-cols-3 gap-5">
        <div class="flex flex-col">
            <img
                v-if="getImagesSrc(animal.images).length === 1"
                :src="getImagesSrc(animal.images)[0]"
                :alt="'Image de ' + animal.name"
                class="w-full h-full object-cover rounded"
            >
            <div v-else-if="getImagesSrc(animal.images).length > 1" class="h-full flex flex-col gap-2">
                <img
                    :src="getImagesSrc(animal.images)[0]"
                    :alt="'Image de ' + animal.name"
                    class="w-full h-[80%] object-cover rounded"
                >
                <div class="grid grid-cols-3 gap-1 h-[20%]">
                    <img
                        v-for="imageSrc in getImagesSrc(animal.images).slice(1)"
                        :src="imageSrc"
                        :alt="`Photo alternative de ${animal.name}`"
                        class="w-full h-full object-cover rounded"
                    />
                </div>
            </div>
            <div v-else
                 class="w-full h-48 bg-gray-200 rounded flex items-center justify-center">
                <span class="text-gray-400">Aucune image</span>
            </div>
        </div>
        <div class="col-span-2">
            <div class="mb-2 flex gap-4 items-center">
                <h2 class="text-2xl font-atten font-black">{{ animal.name }}</h2>
                <span class="text-sm">{{ animal.status }}</span>
            </div>
            <div class="flex gap-10">
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
                    <div class="max-w-[300px] line-clamp-5">
                        <p class="font-bold">Description</p>
                        <p>
                            {{ animal.desc }}
                        </p>
                    </div>
                </dl>
                <div class="flex flex-col w-3/4">
                    <div class="flex justify-between items-center">
                        <p class="font-bold">Notes</p>
                        <button class="underline hover:cursor-pointer" @click="handleCreateNoteModal">
                            + Ajouter
                        </button>
                    </div>
                    <ul class="list-disc list-inside">
                        <li v-if="visibleNotes.length > 0" v-for="(note, i) in visibleNotes" :key="i"
                            class="hover:underline hover:cursor-pointer"
                            @click="handleNoteModal(note)">{{ note.title }}
                        </li>
                        <li v-else class="list-none italic">
                            Pas encore de note
                        </li>
                    </ul>
                    <button
                        v-if="visibleNotes.length !== 0"
                        class="text-end underline self-end hover:cursor-pointer"
                        @click="showMore">
                        <span v-if="!showAll">Afficher plus</span>
                        <span v-else>Afficher moins</span>
                    </button>
                </div>
            </div>
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
        <Modal :condition="isCreateNoteModalOpen" @close="handleCreateNoteModal" index="z-30"
               modal-classes="max-w-[500px]">
            <form @submit.prevent="handleSubmitNote">
                <p class="title">Créer une note</p>
                <div class="flex flex-col">
                    <label for="note-title">Titre de la note</label>
                    <input
                        type="text"
                        id="note-title"
                        v-model="formNoteCreate.title"
                        class="p-2 bg-white border-2 border-main-yellow rounded-lg"
                    >
                    <InputError :message="formNoteCreate.errors.title" />
                </div>

                <div class="flex flex-col">
                    <label for="note-content">Contenu de la note</label>
                    <textarea
                        id="note-content"
                        v-model="formNoteCreate.content"
                        class="p-2 bg-white border-2 border-main-yellow rounded-lg min-h-32"
                    ></textarea>
                    <InputError :message="formNoteCreate.errors.content" />
                </div>
                <div class="flex justify-between">
                    <button type="button" @click="handleCreateNoteModal" class="underline">
                        Annuler
                    </button>
                    <button type="submit" class="button-light">
                        Créer
                    </button>
                </div>
            </form>
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
                    <option v-for="s in status" :value="s.label">{{ s.label }}</option>
                </Select>
                <InputError :message="statusAnimal.errors.status" />
                <button type="submit" class="button-light ml-auto">Changer</button>
            </form>
        </Modal>
        <Modal :condition="isModalOpen" @close="openEditModal" index="z-30" modal-classes="">
            <AnimalEditForm :open-modal="openEditModal" :species="species" :breeds="breeds" :coats="coats"
                            :vaccines="vaccines" :animal="animal" :status="status"
                            @updated="$emit('updated');openEditModal" />
        </Modal>
        <Modal :condition="isNoteModalOpen" @close="handleNoteModal" index="z-30" modal-classes="max-w-[500px]">
            <p class="title">{{ this.noteToShow.title }}</p>
            <p>{{ this.noteToShow.content }}</p>
        </Modal>
    </Teleport>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import { updateStatus } from '@/actions/App/Http/Controllers/AnimalsController';
import { destroy } from '@/actions/App/Http/Controllers/AnimalsController';
import { useToasterStore } from '@/stores/useToasterStore.js';
import Modal from '@/components/widget/Modal.vue';
import { Button } from '@/components/ui/button/index.js';
import Select from '@/components/widget/form/Select.vue';
import InputError from '@/components/InputError.vue';
import AnimalCreateForm from '@/components/widget/form/AnimalCreateForm.vue';
import AnimalEditForm from '@/components/widget/form/AnimalEditForm.vue';
import Input from '../ui/input/Input.vue';
import { store as note_store } from '@/actions/App/Http/Controllers/NotesController.js';

export default {
    props: ['animal', 'coats', 'breeds', 'species', 'status', 'vaccines'],

    components: {
        Input,
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
            isArchiveModalOpen: false,
            isChangeStatusModalOpen: false,
            isVaccineModalOpen: false,
            isCreateNoteModalOpen: false,
            statusAnimal: useForm({
                'status': this.animal.status
            }),
            deleteForm: useForm({
                'id': this.animal.id
            }),
            formNoteCreate: useForm({
                animal_id: null,
                title: '',
                content: ''
            }),
            isModalOpen: false,
            isDeleteModalOpen: false,
            isNoteModalOpen: false,
            noteToShow: null,
            showAll: false,
        };
    },

    computed: {
        visibleNotes() {
            return this.showAll ? this.animal.notes : this.animal.notes.slice(0, 3);
        }
    },

    methods: {
        updateStatus,
        destroy,
        showMore() {
            this.showAll = !this.showAll;
        },
        handleCreateNoteModal() {
            this.isCreateNoteModalOpen = !this.isCreateNoteModalOpen;
        },
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

            if (!age) {
                if (month <= 1 && age < 1) {
                    month = 'Moins d‘un mois';
                } else {
                    month = month + ' mois';
                }
            }
            return `${age}  ${month}`;
        },
        handleArchiveModal() {
            this.isArchiveModalOpen = !this.isArchiveModalOpen;
        },
        openEditModal() {
            this.isModalOpen = !this.isModalOpen;
        },
        handleNoteModal(note) {
            this.isNoteModalOpen = !this.isNoteModalOpen;
            this.noteToShow = note;
        },
        handleChangeStatusModal() {
            this.isChangeStatusModalOpen = !this.isChangeStatusModalOpen;
        },
        handleSubmitNote() {
            this.formNoteCreate.animal_id = this.animal.id;
            this.formNoteCreate.post(note_store(), {
                onSuccess: () => {
                    this.toast.success({ text: 'Note créée' });
                    this.isCreateNoteModalOpen = false;
                    this.formNoteCreate.reset();
                },
                onError: () => {
                    this.toast.error({ text: 'Une erreur est apparue lors de la création' });
                }
            });
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
        handleDeleteModal() {
            this.isDeleteModalOpen = !this.isDeleteModalOpen;
        },

        handleDelete() {
            this.deleteForm.delete(destroy(this.animal.id), {
                onSuccess: () => {
                    this.toast.success({ text: 'Animal supprimé avec succès !' });
                    this.$emit('deleted');
                },
                onError: () => {
                    this.toast.error({ text: 'Une erreur s‘est produite lors de la manipulation' });
                }
            });
        },
        getImagesSrc(imageData) {
            if (!imageData) return [];
            const parsed = typeof imageData === 'string'
                ? JSON.parse(imageData)
                : imageData;
            return Object.keys(parsed);
        }
    }

};
</script>
