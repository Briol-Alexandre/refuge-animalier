<template>
    <form class="grid grid-cols-2 gap-x-4 gap-y-2" @submit.prevent="handleSubmit">
        <p class="col-span-full title">
            Créer la fiche d'une adoption
        </p>
        <div class="flex flex-col">
            <label for="adopter">Choisir un adoptant</label>
            <multiselect id="adopter" :options="adopters" track-by="name" label="name" v-model="formAdoption.adopter_id"
                         placeholder="Choisir un adoptant">
                <template #singleLabel="{ option }">
                    <span>{{ option.name }}</span>
                </template>

                <template #option="{ option }">
                    <div>
                        <strong class="!text-black">{{ option.name }}</strong>
                        <div class="text-sm text-gray-600">{{ option.email }}</div>
                    </div>
                </template>
            </multiselect>
            <InputError :message="formAdoption.errors.adopter_id"></InputError>
        </div>
        <div class="flex flex-col">
            <label for="animal">Choisir un animal</label>
            <multiselect id="animal" :options="filteredAnimals" track-by="name" label="name"
                         v-model="formAdoption.animal_id"
                         placeholder="Choisir un animal">
            </multiselect>
            <InputError :message="formAdoption.errors.animal_id"></InputError>

        </div>
        <div>
            <label for="date">
                Date de l'adoption <small>laissez vide si pas cloturé</small>
            </label>
            <input type="date" v-model="formAdoption.adoption_date"
                   class="p-2 bg-white border-2 border-main-yellow rounded-lg w-full">
            <InputError :message="formAdoption.errors.adoption_date"></InputError>

        </div>
        <div>
            <Select
                v-if="isAdmin"
                v-model="formAdoption.status"
                id-name="status"
                label="Statut de l'adoption"
            >
                <option value="">--Choisir un statut--</option>
                <option v-for="statu in status" :value="statu.value">{{ statu.label }}</option>
            </Select>
            <div v-else class="flex flex-col opacity-75 -z-10">
                <p>Status</p>
                <p class="p-2 bg-white border-2 border-main-yellow rounded-lg hover:cursor-not-allowed">
                    En attente
                </p>
            </div>
            <InputError :message="formAdoption.errors.status"></InputError>
        </div>
        <div class="mt-4 col-span-full">
            <p class="font-bold">Notes</p>
            <div>
                <label for="title">
                    Titre de la note
                </label>
                <input type="text" id="title" v-model="formAdoption.note['title']" placeholder="Titre"
                       class="p-2 bg-white border-2 border-main-yellow rounded-lg w-full">
            </div>
            <div class="flex flex-col">
                <label for="note['content']">Contenu de la note</label>
                <textarea id="note['content']" v-model="formAdoption.note['content']"
                          class="p-2 bg-white border-2 border-main-yellow rounded-lg min-h-32"
                          placeholder="Écrivez une note…" />
            </div>
            <InputError :message="formAdoption.errors.note"></InputError>
        </div>
        <div class="col-span-full">
            <button class="button-light">
                Créer
            </button>
        </div>
    </form>
</template>

<script>
import Select from '@/components/widget/form/Select.vue';
import Multiselect from 'vue-multiselect';
import Modal from '@/components/widget/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import { store as adoption_store } from '@/actions/App/Http/Controllers/AdoptionsController.js';
import { useToasterStore } from '@/stores/useToasterStore';
import InputError from '@/components/InputError.vue';


export default {
    name: '',
    components: { InputError, Modal, Select, Multiselect },
    props: ['openModal', 'animals', 'adopters', 'status', 'isAdmin'],

    data() {
        return {
            modalToOpen: '',
            formAdoption: useForm({
                animal_id: '',
                adopter_id: '',
                status: this.isAdmin ? '' : 'pending',
                adoption_date: '',
                note: {
                    title: '',
                    content: ''
                }
            }),
            toast: useToasterStore()
        };
    },

    computed: {
        filteredAnimals(animals) {
            return this.animals.filter((animal) => {
                    return animal.status === 'available';
                }
            );
        }
    },

    methods: {
        adoption_store,
        handleSubmit() {
            this.formAdoption.post(adoption_store(), {
                onSuccess: () => {
                    this.toast.success({ text: 'Adoption créée avec succès' });
                    this.$emit('created');
                }
            });
        }
    }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>

</style>
