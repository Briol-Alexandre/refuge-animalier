<template>
    <form action="" method="post" class="grid grid-cols-6 gap-x-4 gap-y-2" @submit="handleSubmit">
        <p class="col-span-full title">
            Créer la fiche d'un animal
        </p>
        <div class="col-span-2 h-full">
            <InputLabel type="file" id-name="avatar" input-class="hidden"
                        label-class="w-full h-full bg-softGray/50 flex items-center justify-center">
                <div class="text-center flex flex-col items-center">
                    <ImageAdd fill-color="#ECECEC" />
                    Ajouter une ou <span class="block">plusieurs photos</span>
                </div>
            </InputLabel>
        </div>
        <fieldset class="col-span-4 grid grid-cols-2 gap-x-4 gap-y-2">
            <InputLabel id-name="name" type="text" placeholder="Moka">
                Nom de l'animal
            </InputLabel>

            <Select v-model="specie" id-name="specie" label="Type d‘animal" @change="addElModal">
                <option value="">--Choisir une espèce--</option>
                <option value="add-specie">+ Ajouter une espèce</option>
                <option v-for="specie in species" :value="specie.id">{{ specie.name }}</option>
            </Select>

            <Select v-model="breed" id-name="breed" label="Race de l‘animal" @change="addElModal">
                <option value="">--Choisir une race--</option>
                <option value="add-breed">+ Ajouter une race</option>
                <option v-for="breed in breeds" value="breed.id">{{ breed.name }}</option>
            </Select>

            <Select v-model="coat" id-name="coat" label="Pelage de l‘animal" @change="addElModal">
                <option value="">--Choisir un pelage--</option>
                <option value="add-coat">+ Ajouter un pelage</option>
                <option v-for="coat in coats" :value="coat.id">{{ coat.name }}</option>
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
                <option value="add-vaccine">+ Ajouter une option</option>
                <option value="uptodate">À jour</option>
                <option value="todo">À faire</option>
            </Select>

            <Select v-model="animalStatus" id-name="status" label="Statut" @change="addElModal">
                <option value="">--Choisir un statut--</option>
                <option v-for="status in statusList" :value="status">{{ status }}</option>
            </Select>

        </fieldset>
        <div class="col-span-full grid grid-cols-2 gap-x-4">
            <TextareaLabel id-name="description" placeholder="Écrivez la description…" input-class="min-h-32">
                Description de l'animal
            </TextareaLabel>
            <TextareaLabel id-name="note" placeholder="Écrivez la note…" input-class="min-h-32">
                Note de l'animal <small>seuls vous et les bénévoles la verront</small>
            </TextareaLabel>
        </div>
        <div class="col-span-full flex justify-between items-center">
            <button class="underline hover:cursor-pointer" @click="openModal">
                Annuler
            </button>
            <button type="submit" class="button-light w-fit">
                Créer la fiche
            </button>
        </div>
    </form>
    <Teleport to="body">

        <Modal :condition="modalToOpen === 'specie'" @close="modalToOpen = ''" index="z-30"
               modal-classes="max-w-[500px]">
            <form class="flex flex-col gap-4"
                  @submit.prevent="submitSpecie">
                <p class="col-span-full title !mb-0">
                    Créer une espèce
                </p>
                <div class="flex flex-col h-full">
                    <label for="name">Nom de l'espèce</label>
                    <input
                        id="name"
                        name="name"
                        v-model="formSpecie.name"
                        placeholder="Ex. Chihuahua"
                        class="p-2 bg-white border-2 border-main-yellow rounded-lg"
                    >
                    <InputError :message="formSpecie.errors.name" />
                </div>
                <button type="submit" class="button-light ml-auto">Créer l'espèce</button>
            </form>
        </Modal>

        <Modal :condition="modalToOpen === 'breed'" @close="modalToOpen = ''" index="z-30"
               modal-classes="max-w-[500px]">
            <form class="grid grid-cols-2 gap-4" @submit.prevent="submitBreed">
                <p class="col-span-full title !mb-0">
                    Créer une race
                </p>
                <div class="flex flex-col h-full">
                    <label for="name">Nom de la race</label>
                    <input
                        id="name"
                        name="name"
                        v-model="formBreed.name"
                        placeholder="Ex. Chihuahua"
                        class="p-2 bg-white border-2 border-main-yellow rounded-lg"
                    >
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
                <p class="col-span-full title !mb-0">
                    Créer un type de pelage
                </p>
                <div class="flex flex-col h-full">
                    <label for="name">Nom du pellage</label>
                    <input
                        id="name"
                        name="name"
                        v-model="formCoat.name"
                        placeholder="Ex. Gris"
                        class="p-2 bg-white border-2 border-main-yellow rounded-lg"
                    >
                    <InputError :message="formCoat.errors.name" />
                </div>
                <button type="submit" class="button-light ml-auto">Créer le pellage</button>
            </form>
        </Modal>
        <Modal :condition="modalToOpen === 'vaccine'" @close="modalToOpen = ''" index="z-30">
            Modal Vaccin
        </Modal>
        <Modal :condition="modalToOpen === 'status'" @close="modalToOpen = ''" index="z-30">
            Modal Statut
        </Modal>
    </Teleport>
</template>

<script>
import InputLabel from '@/components/widget/form/InputLabel.vue';
import TextareaLabel from '@/components/widget/form/TextareaLabel.vue';
import Select from '@/components/widget/form/Select.vue';
import ImageAdd from '@/components/svgs/ImageAdd.vue';
import { Button } from '@/components/ui/button/index.js';
import Modal from '@/components/widget/Modal.vue';
import { nextTick } from 'vue';
import { Form, useForm, usePage } from '@inertiajs/vue3';
import { store as species_store } from '@/actions/App/Http/Controllers/SpeciesController';
import { store as breeds_store } from '@/actions/App/Http/Controllers/BreedsController';
import { store as coats_store } from '@/actions/App/Http/Controllers/CoatsController';
import { useToasterStore } from '@/stores/useToasterStore';
import InputError from '@/components/InputError.vue';
import Input from '../../ui/input/Input.vue';
import { useStatusStore } from '@/stores/statusStore.js';

export default {
    name: '',
    components: {
        Input,
        InputError,
        Form,
        Modal,
        Button,
        ImageAdd,
        Select,
        TextareaLabel,
        InputLabel,
        useToasterStore
    },
    props: ['openModal', 'species', 'breeds', 'coats'],

    data() {
        return {
            specie: '',
            breed: '',
            coat: '',
            vaccine: '',
            animalStatus: '',
            modalToOpen: '',
            toast: useToasterStore(),
            formBreed: useForm({
                name: '',
                specie_id: ''
            }),
            formSpecie: useForm({
                name: ''
            }),
            formCoat: useForm({
                name: ''
            }),
            page: usePage(),
            statusList: useStatusStore().statusList,
        };
    },

    methods: {
        species_store,
        breeds_store,
        coats_store,
        addElModal() {
            if (this.specie === 'add-specie') {
                this.modalToOpen = 'specie';
                nextTick(() => {
                    this.specie = '';
                });
            }
            if (this.breed === 'add-breed') {
                this.modalToOpen = 'breed';
                nextTick(() => {
                    this.breed = '';
                });
            }
            if (this.coat === 'add-coat') {
                this.modalToOpen = 'coat';
                nextTick(() => {
                    this.coat = '';
                });
            }
            if (this.vaccine === 'add-vaccine') {
                this.modalToOpen = 'vaccine';
                nextTick(() => {
                    this.vaccine = '';
                });
            }
            if (this.animalStatus === 'add-status') {
                this.modalToOpen = 'status';
                nextTick(() => {
                    this.animalStatus = '';
                });
            }
        },
        handleSubmit() {
            const form = useForm();
            console.log(form);
        },
        submitBreed() {
            this.formBreed.post(breeds_store(), {
                onSuccess: (page) => {
                    this.toast.success({ text: 'Race créée avec succès !' });
                    this.modalToOpen = '';
                    this.formBreed.reset();
                },
                onError: (errors) => {
                    this.toast.success({ text: 'Une erreur est apparue lors de la création' });
                }
            });
        },
        submitSpecie() {
            this.formSpecie.post(species_store(), {
                onSuccess: (page) => {
                    this.toast.success({ text: 'Espèce créée avec succès !' });
                    this.modalToOpen = '';
                    this.formSpecie.reset();
                },
                onError: (errors) => {
                    this.toast.success({ text: 'Une erreur est apparue lors de la création' });
                }
            });
        },
        submitCoat() {
            this.formCoat.post(coats_store(), {
                onSuccess: (page) => {
                    this.toast.success({ text: 'Pelage créée avec succès !' });
                    this.modalToOpen = '';
                    this.formCoat.reset();
                },
                onError: (errors) => {
                    this.toast.success({ text: 'Une erreur est apparue lors de la création' });
                }
            });
        }
    }
};
</script>

<style>

</style>
