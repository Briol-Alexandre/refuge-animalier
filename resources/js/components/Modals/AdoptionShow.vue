<template>
    <div class="grid grid-cols-2 gap-y-10">
        <div>
            <p class="font-atten text-2xl font-black">Adoptant</p>
            <dl>
                <div class="flex gap-2">
                    <dt class="font-medium">Nom&nbsp;:</dt>
                    <dd>{{ adopter.name }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-medium">Email&nbsp;:</dt>
                    <dd>{{ adopter.email }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-medium">Téléphone&nbsp;:</dt>
                    <dd>{{ adopter.tel }}</dd>
                </div>
            </dl>

        </div>
        <div>
            <p class="font-atten text-2xl font-black">Animal</p>
            <dl>
                <div class="flex gap-2">
                    <dt class="font-medium">Nom&nbsp;:</dt>
                    <dd>{{ animal.name }}</dd>
                </div>
            </dl>
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
                <li v-for="(note, i) in visibleNotes" :key="i" class="hover:underline hover:cursor-pointer"
                    @click="handleNoteModal(note)">{{ note.title }}
                </li>
            </ul>
            <button
                class="text-end underline self-end hover:cursor-pointer"
                @click="showMore">
                <span v-if="!showAll">Afficher plus</span>
                <span v-else>Afficher moins</span>
            </button>
        </div>
        <div class="col-span-full">
            <p class="font-atten text-2xl font-black">Prise de contact <small>(formulaire rempli par l'adoptant)</small>
            </p>
            <p>{{ adoption.contact_message }}</p>

        </div>
        <div class="col-span-full flex justify-center gap-4">
            <button class="button-dark">Archiver la fiche</button>
            <button class="button-light">Modifier la fiche</button>
        </div>
    </div>
    <Teleport to="body">
        <Modal :condition="isNoteModalOpen" @close="handleNoteModal" index="z-30" modal-classes="max-w-[500px]">
            <p class="title">{{ this.noteToShow.title }}</p>
            <p>{{ this.noteToShow.content }}</p>
        </Modal>
        <Modal :condition="isCreateNoteModalOpen" @close="handleCreateNoteModal" index="z-30" modal-classes="max-w-[500px]">
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
    </Teleport>
</template>

<script>
import Modal from '@/components/widget/Modal.vue';
import InputLabel from '@/components/widget/form/InputLabel.vue';
import TextareaLabel from '@/components/widget/form/TextareaLabel.vue';
import InputError from '@/components/InputError.vue';
import Input from '../ui/input/Input.vue';
import { Button } from '@/components/ui/button/index.js';
import { useForm } from '@inertiajs/vue3';
import { store as note_store } from '@/actions/App/Http/Controllers/NotesController.js';

export default {
    name: 'AdoptionShow',
    props: ['adoption', 'animal', 'adopter'],
    components: {
        Button, Input, InputError,
        Modal,
        InputLabel,
        TextareaLabel
    },

    data() {
        return {
            showAll: false,
            isNoteModalOpen: false,
            noteToShow: null,
            isCreateNoteModalOpen: false,
            formNoteCreate: useForm({
                adoption_id: null,
                title: '',
                content: '',
            }),
        };
    },
    computed: {
        visibleNotes() {
            return this.showAll ? this.adoption.notes : this.adoption.notes.slice(0, 3);
        }
    },

    methods: {
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
                onSuccess:() =>{
                    this.toast.success({text: 'Note créée'});
                    this.isCreateNoteModalOpen = false;
                    this.formNoteCreate.reset();
                },
                onError:() =>{
                    this.toast.error({text: 'Une erreur est apparue lors de la création' });
                }
            })
        },
    }
};
</script>

<style>

</style>
