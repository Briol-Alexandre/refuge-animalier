<template>
    <form class="grid grid-cols-6 gap-x-4 gap-y-2" @submit.prevent="handleSubmit">
        <p class="col-span-full title">
            Modifier la fiche de {{ animal.name }}
        </p>

        <div class="col-span-2 h-full">
            <div class="flex flex-col h-full">
                <label for="images" class="relative w-full h-full flex items-center justify-center">
                    <div v-if="getImagesSrc(animal.images).length === 0" class="text-center flex flex-col items-center">
                        <ImageAdd fill-color="#ECECEC" />
                        Ajouter une ou <span class="block">plusieurs photos</span>
                    </div>
                    <div v-else
                         class="absolute top-0 left-0 w-full h-full border-none object-cover grid grid-rows-[80%_20%] gap-2">
                        <img
                            v-if="getImagesSrc(animal.images).length > 0"
                            :src="getImagesSrc(animal.images)[0]"
                            class="w-full h-full object-cover col-span-full"
                            alt="" />
                        <div class="grid grid-cols-3 gap-2 w-full h-full">
                            <img
                                v-for="(img, index) in getImagesSrc(animal.images).slice(1)"
                                :key="index"
                                :src="img"
                                class="w-full h-full object-cover"
                                alt="" />
                        </div>
                    </div>

                    <InputError :message="formAnimal.errors.images" />
                </label>
                <input
                    id="images"
                    type="file"
                    multiple
                    @change="handleFiles($event)"
                    class="hidden"
                />
                <InputError :message="formAnimal.errors.images" />
            </div>
        </div>

        <fieldset class="col-span-4 grid grid-cols-2 gap-x-4 gap-y-2">
            <div class="flex flex-col h-full">
                <label for="name">
                    Nom de l'animal
                </label>
                <input id="name" type="text" v-model="formAnimal.name"
                       class="p-2 bg-white border-2 border-main-yellow rounded-lg" placeholder="Ex. Moka">
                <InputError :message="formAnimal.errors.name" />

                <p @click="console.log(animal)">test</p>
            </div>

            <Select
                :modelValue="formAnimal.specie_id"
                @update:modelValue="handleSpecieChange"
                id-name="specie"
                label="Type d'animal"
            >
                <option value="">--Choisir une espèce--</option>
                <option value="add-specie">+ Ajouter une espèce</option>
                <option v-for="specie in species" :value="specie.id">{{ specie.name }}</option>
            </Select>

            <Select
                :modelValue="formAnimal.breed_id"
                @update:modelValue="handleBreedChange"
                id-name="breed"
                label="Race de l‘animal"
                multiple
            >
                <option value="">--Choisir une race--</option>
                <option value="add-breed">+ Ajouter une race</option>
                <option v-for="breed in filteredBreeds" :value="breed.id">{{ breed.name }}</option>
            </Select>
            <div>
                <p>
                    Pelage de l'animal
                </p>
                <div @click.self="this.isCoatModalOpen = !this.isCoatModalOpen"
                     class="p-2 bg-white border-2 border-main-yellow rounded-lg relative hover:cursor-pointer">
                    <span v-if="formAnimal.coat_id.length === 0"
                          @click.self="this.isCoatModalOpen = !this.isCoatModalOpen">--&nbsp;Choisir un pelage&nbsp;--</span>
                    <span v-else
                          v-for="coat in selectedCoats"
                          :key="coat.id"
                          class="mr-1"
                          @click.self="this.isCoatModalOpen = !this.isCoatModalOpen"
                    >
                            {{ coat.name }}
                    </span>
                    <div v-if="this.isCoatModalOpen"
                         class="absolute top-0 left-0 bg-white border-2 border-main-yellow p-2 rounded-md w-full">
                        <p @click="modalToOpen = 'coat'" class="mb-4">+ Ajouter un pelage</p>
                        <span @click.stop="this.isCoatModalOpen = !this.isCoatModalOpen; this.formAnimal.coat_id = []"
                              class="absolute top-2 right-2 hover:cursor-pointer">
                            <Close />
                        </span>
                        <div v-for="coat in coats" :key="coat.id" class="flex gap-2">
                            <input
                                type="checkbox"
                                :id="'coat[' + coat.id + ']'"
                                :value="coat.id"
                                v-model="formAnimal.coat_id"
                            >
                            <label :for="'coat[' + coat.id + ']'">{{ coat.name }}</label>
                        </div>
                        <span @click.stop="this.isCoatModalOpen = !this.isCoatModalOpen"
                              class="underline absolute bottom-2 right-2">
                                Appliquer
                        </span>

                    </div>
                </div>
            </div>


            <div class="flex flex-col h-full">
                <label for="age">
                    Date de naissance de l'animal
                </label>
                <input id="age" type="date" v-model="formAnimal.age"
                       class="p-2 bg-white border-2 border-main-yellow rounded-lg">
                <InputError :message="formAnimal.errors.age" />
            </div>

            <Select v-model="formAnimal.sexe" id-name="sexe" label="Sexe de l‘animal">
                <option value="">--Choisir un sexe--</option>
                <option value="male">Mâle</option>
                <option value="female">Femelle</option>
            </Select>

            <div>
                <p>Vaccins de l'animal</p>
                <div @click.self="isVaccineModalOpen = !isVaccineModalOpen"
                     class="p-2 bg-white border-2 border-main-yellow rounded-lg relative hover:cursor-pointer">
                    <span
                        v-if="formAnimal.vaccines.length === 0"
                        @click.self="this.isVaccineModalOpen = !this.isVaccineModalOpen">--&nbsp;Choisir des vaccins&nbsp;--</span>
                    <span v-else
                          v-for="vaccine in selectedVaccines"
                          :key="vaccine.id"
                          class="mr-1"
                          @click.self="this.isVaccineModalOpen = !this.isVaccineModalOpen"
                    >
                        {{ vaccine.name }}
                    </span>

                    <div v-if="isVaccineModalOpen"
                         class="absolute top-0 left-0 bg-white border-2 border-main-yellow p-2 rounded-md w-full">
                        <p @click="modalToOpen = 'vaccine'; isVaccineModalOpen = false" class="mb-4">+ Ajouter un
                            vaccin</p>
                        <span @click.stop="isVaccineModalOpen = !isVaccineModalOpen; formAnimal.vaccines = []"
                              class="absolute top-2 right-2 hover:cursor-pointer">
                            <Close />
                        </span>
                        <div v-for="vaccine in filteredVaccines" :key="vaccine.id" class="flex gap-2">
                            <input
                                type="checkbox"
                                :id="'vaccine[' + vaccine.id + ']'"
                                :value="vaccine.id"
                                v-model="formAnimal.vaccines"
                            >
                            <label :for="'vaccine[' + vaccine.id + ']'">{{ vaccine.name }}</label>
                        </div>
                        <span @click.stop="isVaccineModalOpen = !isVaccineModalOpen"
                              class="underline absolute bottom-2 right-2">
                            Appliquer
                        </span>
                    </div>
                </div>
            </div>

            <Select
                :modelValue="formAnimal.status"
                @update:modelValue="handleStatusChange"
                id-name="status"
                label="Statut"
            >
                <option value="">--Choisir un statut--</option>
                <option v-for="status in status" :value="status.label">{{ status.label }}</option>
            </Select>
        </fieldset>

        <div class="col-span-full grid grid-cols-2 gap-x-4">
            <div class="flex flex-col h-full">
                <label for="desc">
                    Description de l'animal
                </label>
                <textarea id="desc" v-model="formAnimal.desc"
                          class="p-2 bg-white border-2 border-main-yellow rounded-lg min-h-32"
                          placeholder="Écrivez la description…"></textarea>
                <InputError :message="formAnimal.errors.desc" />
            </div>
            <div class="flex flex-col h-full">
                <div class="flex justify-between">
                    <p>
                        Notes
                    </p>
                    <p class="underline hover:cursor-pointer hover:no-underline" @click="handleCreateNoteModal">
                        + Ajouter une note
                    </p>
                </div>
                <ul class="list-disc list-inside">
                    <li v-for="note in localNotes"
                        :key="note.id"
                        @click="handleNoteModal(note)"
                        class="underline hover:cursor-pointer hover:no-underline w-fit">
                        {{ note.title }}
                    </li>
                </ul>
            </div>

        </div>

        <div class="col-span-full flex justify-between items-center">
            <button class="underline hover:cursor-pointer" @click="openModal">
                Annuler
            </button>
            <button type="submit" class="button-light w-fit">
                Modifier la fiche
            </button>
        </div>
    </form>
    <Teleport to="body">
        <Modal :condition="modalToOpen === 'specie'" @close="modalToOpen = ''" index="z-30"
               modal-classes="max-w-[500px]">
            <form class="flex flex-col gap-4" @submit.prevent="submitSpecie">
                <p class="col-span-full title !mb-0">Créer une espèce</p>
                <div class="flex flex-col h-full">
                    <label for="name">Nom de l'espèce</label>
                    <input id="name" name="name" v-model="formSpecie.name" placeholder="Ex. Chihuahua"
                           class="p-2 bg-white border-2 border-main-yellow rounded-lg">
                    <InputError :message="formSpecie.errors.name" />
                </div>
                <button type="submit" class="button-light ml-auto">Créer l'espèce</button>
            </form>
        </Modal>

        <Modal :condition="modalToOpen === 'breed'" @close="modalToOpen = ''" index="z-30"
               modal-classes="max-w-[500px]">
            <form class="grid grid-cols-2 gap-4" @submit.prevent="submitBreed">
                <p class="col-span-full title !mb-0">Créer une race</p>
                <div class="flex flex-col h-full">
                    <label for="name">Nom de la race</label>
                    <input id="name" name="name" v-model="formBreed.name" placeholder="Ex. Chihuahua"
                           class="p-2 bg-white border-2 border-main-yellow rounded-lg">
                    <InputError :message="formBreed.errors.name" />
                </div>
                <Select id-name="specie_id" label="Espèce liée" v-model="formBreed.specie_id">
                    <option value="">--Choisir une espèce--</option>
                    <option v-for="specie in species" :value="specie.id">{{ specie.name }}</option>
                </Select>
                <InputError :message="formBreed.errors.specie_id" />
                <button type="submit" class="button-light ml-auto">Créer la race</button>
            </form>
        </Modal>

        <Modal :condition="modalToOpen === 'coat'" @close="modalToOpen = ''" index="z-30" modal-classes="max-w-[500px]">
            <form class="grid grid-cols-2 gap-4" @submit.prevent="submitCoat">
                <p class="col-span-full title !mb-0">Créer un type de pelage</p>
                <div class="flex flex-col h-full">
                    <label for="name">Nom du pelage</label>
                    <input id="name" name="name" v-model="formCoat.name" placeholder="Ex. Gris"
                           class="p-2 bg-white border-2 border-main-yellow rounded-lg">
                    <InputError :message="formCoat.errors.name" />
                </div>
                <button type="submit" class="button-light ml-auto">Créer le pelage</button>
            </form>
        </Modal>

        <Modal :condition="modalToOpen === 'vaccine'" @close="modalToOpen = ''" index="z-30">
            Modal Vaccin
        </Modal>
        <Modal :condition="isNoteModalOpen" @close="handleNoteModal" index="z-30" modal-classes="max-w-[500px]">
            <form @submit.prevent="handleSubmitUpdateNote">
                <p class="title">Modifier la note</p>
                <div class="flex flex-col">
                    <label for="note-title">Titre de la note</label>
                    <input
                        type="text"
                        id="note-title"
                        v-model="formNote.title"
                        class="p-2 bg-white border-2 border-main-yellow rounded-lg"
                    >
                    <InputError :message="formNote.errors.title" />
                </div>

                <div class="flex flex-col">
                    <label for="note-content">Contenu de la note</label>
                    <textarea
                        id="note-content"
                        v-model="formNote.content"
                        class="p-2 bg-white border-2 border-main-yellow rounded-lg min-h-32"
                    ></textarea>
                    <InputError :message="formNote.errors.content" />
                </div>
                <div class="flex justify-between">
                    <button type="button" @click="deleteNote" class="underline">
                        Supprimer
                    </button>
                    <button type="submit" class="button-light">
                        Modifier
                    </button>
                </div>
            </form>
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
                    <button type="button" @click="handleNoteModal()" class="underline">
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
import InputError from '@/components/InputError.vue';
import { Button } from '@/components/ui/button/index.js';
import Select from '@/components/widget/form/Select.vue';
import Close from '@/components/svgs/Close.vue';
import ImageAdd from '@/components/svgs/ImageAdd.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { store as species_store } from '@/actions/App/Http/Controllers/SpeciesController.js';
import { store as breeds_store } from '@/actions/App/Http/Controllers/BreedsController.js';
import { store as coats_store } from '@/actions/App/Http/Controllers/CoatsController.js';
import { store as animal_store } from '@/actions/App/Http/Controllers/AnimalsController.js';
import { store as note_store } from '@/actions/App/Http/Controllers/NotesController.js';
import { update as animal_update } from '@/actions/App/Http/Controllers/AnimalsController.js';
import { update as note_update } from '@/actions/App/Http/Controllers/NotesController.js';
import { destroy as note_delete } from '@/actions/App/Http/Controllers/NotesController.js';
import { useToasterStore } from '@/stores/useToasterStore.js';
import { useStatusStore } from '@/stores/statusStore.js';
import Input from '../../ui/input/Input.vue';
import Modal from '@/components/widget/Modal.vue';

export default {
    name: '',
    components: { Modal, Input, ImageAdd, Close, Select, Button, InputError },
    props: ['animal', 'species', 'breeds', 'coats', 'vaccines', 'status'],

    data() {
        return {
            modalToOpen: '',
            toast: useToasterStore(),
            formBreed: useForm({ name: '', specie_id: '' }),
            formSpecie: useForm({ name: '' }),
            formCoat: useForm({ name: '' }),
            formAnimal: useForm({
                name: '',
                breed_id: '',
                sexe: '',
                age: '',
                specie_id: '',
                desc: '',
                status: '',
                images: '',
                vaccines: [],
                note: {
                    title: '',
                    content: ''
                },
                coat_id: []
            }),
            isCoatModalOpen: false,
            isVaccineModalOpen: false,
            page: usePage(),
            formNote: useForm({
                id: null,
                title: '',
                content: ''
            }),
            formNoteCreate: useForm({
                animal_id: null,
                title: '',
                content: '',
            }),
            isNoteModalOpen: false,
            noteToShow: '',
            isCreateNoteModalOpen: false,
            localNotes: []
        };
    },

    mounted() {
        if (this.animal) {
            this.formAnimal.name = this.animal.name || '';
            this.formAnimal.specie_id = this.animal.specie.id || '';
            this.formAnimal.breed_id = this.animal.breed_id || '';
            this.formAnimal.sexe = this.animal.sexe || '';
            this.formAnimal.age = this.animal.age || '';
            this.formAnimal.desc = this.animal.desc || '';
            this.formAnimal.status = this.animal.status || '';
            this.formAnimal.vaccines = this.animal.vaccines
                ? this.animal.vaccines.map(v => v.id)
                : [];
            this.formAnimal.note = {
                title: this.noteToShow.title,
                content: this.noteToShow.content
            };
            this.formAnimal.coat_id = this.animal.coat
                ? this.animal.coat.map(c => c.id)
                : [];
            this.formAnimal.images = this.animal.images || null;
        }
        this.localNotes = [...this.animal.notes];
    },


    computed: {
        filteredBreeds() {
            if (!this.formAnimal.specie_id) return this.breeds;
            return this.breeds.filter(breed => breed.specie_id === parseInt(this.formAnimal.specie_id));
        },
        filteredVaccines() {
            if (!this.formAnimal.specie_id) return this.vaccines;
            return this.vaccines.filter(vaccine => vaccine.specie_id === parseInt(this.formAnimal.specie_id));
        },
        selectedCoats() {
            return this.coats.filter(c => this.formAnimal.coat_id.includes(c.id));
        },
        selectedVaccines() {
            return this.vaccines.filter(v => this.formAnimal.vaccines.includes(v.id));
        }

    },

    methods: {
        species_store,
        breeds_store,
        coats_store,
        animal_store,
        animal_update,
        note_update,
        note_store,
        note_delete,

        handleSpecieChange(value) {
            if (value === 'add-specie') {
                this.modalToOpen = 'specie';
                this.formAnimal.specie_id = '';
            } else {
                this.formAnimal.specie_id = value;
            }
        },
        handleBreedChange(value) {
            if (value.includes('add-breed')) {
                this.modalToOpen = 'breed';
                this.formAnimal.breed_id = [];
            } else {
                this.formAnimal.breed_id = value;
            }
        },
        handleCoatChange(value) {
            if (value === 'add-coat') {
                this.modalToOpen = 'coat';
                this.formAnimal.coat_id = '';
            } else {
                this.formAnimal.coat_id = value;
            }
        },
        handleVaccineChange(value) {
            if (value === 'add-vaccine') {
                this.modalToOpen = 'vaccine';
                this.formAnimal.vaccine = '';
            } else {
                this.formAnimal.vaccine = value;
            }
        },
        handleStatusChange(value) {
            if (value === 'add-status') {
                this.modalToOpen = 'status';
                this.formAnimal.status = '';
            } else {
                this.formAnimal.status = value;
            }
        },
        handleFiles(event) {
            const files = event.target.files;
            this.formAnimal.images = Array.from(files);
        },
        handleCreateNoteModal() {
            this.isCreateNoteModalOpen = !this.isCreateNoteModalOpen;
        },
        handleSubmit() {
            this.formAnimal._method = 'PUT';
            this.formAnimal.post(animal_update(this.animal.id), {
                onSuccess: () => {
                    this.toast.success({ text: 'Animal modifié avec succès !' });
                    this.$emit('updated');
                },
                onError: () => {
                    this.toast.success({ text: 'Une erreur est apparue lors de la création' });
                }
            });
        },

        submitBreed() {
            this.formBreed.post(breeds_store(), {
                onSuccess: () => {
                    this.toast.success({ text: 'Race créée avec succès !' });
                    this.modalToOpen = '';
                    this.formBreed.reset();
                },
                onError: () => {
                    this.toast.success({ text: 'Une erreur est apparue lors de la création' });
                }
            });
        },
        submitSpecie() {
            this.formSpecie.post(species_store(), {
                onSuccess: () => {
                    this.toast.success({ text: 'Espèce créée avec succès !' });
                    this.modalToOpen = '';
                    this.formSpecie.reset();
                },
                onError: () => {
                    this.toast.success({ text: 'Une erreur est apparue lors de la création' });
                }
            });
        },
        submitCoat() {
            this.formCoat.post(coats_store(), {
                onSuccess: () => {
                    this.toast.success({ text: 'Pelage créé avec succès !' });
                    this.modalToOpen = '';
                    this.formCoat.reset();
                },
                onError: () => {
                    this.toast.error({ text: 'Une erreur est apparue lors de la création' });
                }
            });
        },
        getImagesSrc(imageData) {
            if (!imageData) return [];
            const parsed = typeof imageData === 'string'
                ? JSON.parse(imageData)
                : imageData;
            return Object.keys(parsed);
        },
        handleNoteModal(note = null) {
            this.isNoteModalOpen = !this.isNoteModalOpen;

            if (note) {
                this.formNote.id = note.id;
                this.formNote.title = note.title || '';
                this.formNote.content = note.content || '';
            } else {
                this.formNote.reset();
                this.formNote.id = null;
            }
        },
        handleSubmitUpdateNote() {
            this.formNote.put(note_update(this.formNote.id), {
                onSuccess: () => {
                    this.toast.success({ text: 'Note mise à jour' });
                    this.isNoteModalOpen = false;
                    const noteIndex = this.animal.notes.findIndex(
                        note => note.id === this.formNote.id
                    );

                    if (noteIndex !== -1) {
                        this.animal.notes[noteIndex] = {
                            ...this.animal.notes[noteIndex],
                            title: this.formNote.title,
                            content: this.formNote.content
                        };
                    }
                },
                onError: () => {
                    this.toast.error({ text: 'Une erreur est apparue lors de la modification' });
                }
            });
        },
        handleSubmitNote() {
            this.formNoteCreate.animal_id = this.animal.id;
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
        deleteNote() {
            this.formNote.delete(note_delete(this.formNote.id), {
                onSuccess: () => {
                    this.toast.success({text: 'Note suprimée avec succes'});
                    this.isNoteModalOpen = false;
                    this.animal.notes = this.animal.notes.filter(note => note.id !== this.formNote.id);
                },
            })
        }
    }
};
</script>

<style>

</style>
