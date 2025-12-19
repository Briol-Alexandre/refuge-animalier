<template>
    <div class="grid grid-cols-2 gap-x-5 gap-y-10">
        <div>
            <p class="font-atten text-2xl font-black">Adoptant</p>
            <dl>
                <div class="flex gap-2">
                    <dt class="font-bold">Nom&nbsp;:</dt>
                    <dd>{{ adopter.name }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Email&nbsp;:</dt>
                    <dd>{{ adopter.email }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Téléphone&nbsp;:</dt>
                    <dd>{{ adopter.tel }}</dd>
                </div>
            </dl>
            <div class="mt-4">
                <p class="font-atten text-2xl font-black leading-none mb-2">Prise de contact <small
                    class="block font-poppins font-medium text-sm">(formulaire rempli par l'adoptant)</small>
                </p>
                <p v-if="adoption.contact_message">{{ adoption.contact_message }}</p>
                <p v-else class="italic">Aucun message de contact</p>

            </div>

        </div>
        <div>
            <p class="font-atten text-2xl font-black">Animal</p>
            <div class="flex h-full gap-2">
                <div class="h-full w-1/2">
                    <img
                        :src="getImagesSrc(animal.images)[0]"
                        :alt="'Image de ' + animal.name"
                        class="h-full rounded aspect-video  object-cover"
                    >
                </div>
                <dl>
                    <div class="flex gap-2">
                        <dt class="font-bold">Nom&nbsp;:</dt>
                        <dd>{{ animal.name }}</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="font-bold">Espèce&nbsp;:</dt>
                        <dd>{{ animal.specie.name }}</dd>
                    </div>
                    <div class="flex gap-2">
                        <dt class="font-bold">Race&nbsp;:</dt>
                        <dd>{{ animal.breed.name }}</dd>
                    </div>
                </dl>
            </div>
        </div>
        <div>
            <p class="font-atten text-2xl font-black">Status de l'adoption</p>
            <p>{{ adoption.status }}</p>
        </div>
        <div class="flex flex-col">
            <div class="flex justify-between items-center">
                <p class="font-atten text-2xl font-black">Notes</p>
                <button class="underline hover:cursor-pointer" @click="handleCreateNoteModal">
                    + Ajouter une note
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
                class="text-end underline self-end hover:cursor-pointer"
                @click="showMore">
                <span v-if="!showAll">Afficher plus</span>
                <span v-else>Afficher moins</span>
            </button>
        </div>
        <div class="col-span-full flex justify-center gap-4">
            <button class="button-dark" @click="handleChangeStatusModal">Changer le statut de l'adoption</button>
            <button class="button-light" @click="handleEditModal">Modifier la fiche</button>
        </div>
    </div>
    <Teleport to="body">
        <Modal :condition="isNoteModalOpen" @close="handleNoteModal" index="z-30" modal-classes="max-w-[500px]">
            <p class="title">{{ this.noteToShow.title }}</p>
            <p>{{ this.noteToShow.content }}</p>
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
        <Modal :condition="isEditModalOpened" @close="handleEditModal" index="z-30">
            <AdoptionEditForm :adoption="adoption" :animals="animals" :adopters="adopters" :status="status"
                              :adoptions="adoptions" @closeEditModal="handleEditModal"
                              @updated="$emit('updated'); this.isEditModalOpened=false" />
        </Modal>
        <Modal
            @close="handleArchiveModal"
            :condition="isArchiveModalOpen"
            index="z-30"
            modal-classes="w-fit"
            close-btn-classes="!top-5 !right-5"
        >
            <p>Voulez-vous vraiment archiver cette adoption ? </p>
            <div class="flex justify-between gap-2 mt-6">
                <button class="underline hover:cursor-pointer" @click="handleArchiveModal">Annuler</button>
                <button class="text-red-600 underline hover:cursor-pointer" @click="archiveAdoption">
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
            <form class="flex flex-col gap-2" @submit.prevent="updateAdoptionStatus">
                <p class="title !mb-0">Changer le statut de l'adoption</p>

                <Select id-name="status" label="Statut de l'adoption" v-model="statusAdoption.status">
                    <option value="">--Choisir un status--</option>
                    <option v-for="statusItem in status" :value="statusItem.value">{{ statusItem.label }}</option>
                </Select>
                <InputError :message="statusAdoption.errors.status" />
                <button type="submit" class="button-light ml-auto">Changer</button>
            </form>
        </Modal>
    </Teleport>
</template>

<script>
import Modal from '@/components/widget/Modal.vue';
import InputLabel from '@/components/widget/form/InputLabel.vue';
import TextareaLabel from '@/components/widget/form/TextareaLabel.vue';
import InputError from '@/components/InputError.vue';
import Input from '../ui/input/Input.vue';
import Select from '@/components/widget/form/Select.vue';
import { Button } from '@/components/ui/button/index.js';
import { useForm } from '@inertiajs/vue3';
import { store as note_store } from '@/actions/App/Http/Controllers/NotesController.js';
import { updateStatus } from '@/actions/App/Http/Controllers/AdoptionsController';
import { useToasterStore } from '@/stores/useToasterStore.js';
import AdoptionEditForm from '@/components/widget/form/AdoptionEditForm.vue';
import Dump from '@/components/Debug/Dump.vue';

export default {
    name: 'AdoptionShow',
    props: ['adoption', 'animal', 'adopter', 'adopters', 'animals', 'status', 'adoptions'],
    components: {
        Button,
        Input,
        InputError,
        Modal,
        InputLabel,
        TextareaLabel,
        AdoptionEditForm,
        Select,
        Dump
    },

    data() {
        return {
            toast: useToasterStore(),
            showAll: false,
            isNoteModalOpen: false,
            noteToShow: null,
            isCreateNoteModalOpen: false,
            formNoteCreate: useForm({
                adoption_id: null,
                title: '',
                content: ''
            }),
            isEditModalOpened: false,
            isArchiveModalOpen: false,
            isChangeStatusModalOpen: false,
            statusAdoption: useForm({
                'status': null
            })
        };
    },
    computed: {
        visibleNotes() {
            return this.showAll ? this.adoption.notes : this.adoption.notes.slice(0, 3);
        }
    },

    methods: {
        updateStatus,
        handleEditModal() {
            this.isEditModalOpened = !this.isEditModalOpened;
        },
        showMore() {
            this.showAll = !this.showAll;
        },
        handleNoteModal(note) {
            this.isNoteModalOpen = !this.isNoteModalOpen;
            this.noteToShow = note;
        },
        handleCreateNoteModal() {
            this.isCreateNoteModalOpen = !this.isCreateNoteModalOpen;
        },
        handleSubmitNote() {
            this.formNoteCreate.adoption_id = this.adoption.id;
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
        handleArchiveModal() {
            this.isArchiveModalOpen = !this.isArchiveModalOpen;
        },
        handleChangeStatusModal() {
            this.isChangeStatusModalOpen = !this.isChangeStatusModalOpen;
        },
        archiveAdoption() {
            this.statusAdoption.status = 'Archivé';
            this.statusAdoption.put(updateStatus(this.adoption.id), {
                onSuccess: () => {
                    this.adoption.status = this.statusAdoption.status;
                    this.toast.success({ text: 'Adoption archivée avec succès !' });
                    this.isArchiveModalOpen = false;
                    this.$emit('updated');
                },
                onError: () => {
                    this.toast.error({ text: 'Une erreur s\'est produite lors de l\'archivage' });
                }
            });
        },
        updateAdoptionStatus() {
            this.statusAdoption.put(updateStatus(this.adoption.id), {
                onSuccess: () => {
                    this.adoption.status = this.statusAdoption.status;
                    this.toast.success({ text: 'Statut mis à jour avec succès !' });
                    this.isChangeStatusModalOpen = false;
                    this.$emit('updated');
                },
                onError: () => {
                    this.toast.error({ text: 'Une erreur s\'est produite lors de la mise à jour' });
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

<style>

</style>
