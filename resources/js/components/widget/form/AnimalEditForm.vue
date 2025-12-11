<template>
    <form class="grid grid-cols-6 gap-x-4 gap-y-2" @submit.prevent="handleSubmit">
        <p class="col-span-full title">
            Créer la fiche d'un animal
        </p>

        <div class="col-span-2 h-full">
            <div class="flex flex-col h-full">
                <label for="images" class="w-full h-full bg-softGray/50 flex items-center justify-center">
                    <div class="text-center flex flex-col items-center">
                        <ImageAdd fill-color="#ECECEC" />
                        Ajouter une ou <span class="block">plusieurs photos</span>
                    </div>
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
                <option v-for="status in statusList" :value="status">{{ status }}</option>
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
                <label for="desc">
                    Notes <small>seuls vous et les bénévoles la verront</small>
                </label>
                <textarea id="desc" v-model="formAnimal.note"
                          class="p-2 bg-white border-2 border-main-yellow rounded-lg min-h-32"
                          placeholder="Écrivez une note…" ></textarea>
                <InputError :message="formAnimal.errors.note" />
            </div>

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

        <Modal :condition="modalToOpen === 'status'" @close="modalToOpen = ''" index="z-30">
            Modal Statut
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
import { update as animal_update } from '@/actions/App/Http/Controllers/AnimalsController.js';
import { useToasterStore } from '@/stores/useToasterStore.js';
import { useStatusStore } from '@/stores/statusStore.js';
import Input from '../../ui/input/Input.vue';
import Modal from '@/components/widget/Modal.vue';

export default {
    name: '',
    components: { Modal, Input, ImageAdd, Close, Select, Button, InputError },
    props: ['animal', 'species', 'breeds', 'coats', 'vaccines'],

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
                note: '',
                coat_id: []
            }),
            isCoatModalOpen: false,
            isVaccineModalOpen: false,
            page: usePage(),
            statusList: useStatusStore().statusList
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
            this.formAnimal.note = this.animal.note || '';
            this.formAnimal.coat_id = this.animal.coat
                ? this.animal.coat.map(c => c.id)
                : [];
        }
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
            this.formAnimal.images = files.length > 1 ? Array.from(files) : files[0];
        },


        handleSubmit() {
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
                    this.toast.success({ text: 'Une erreur est apparue lors de la création' });
                }
            });
        }
    }
};
</script>

<style>

</style>
