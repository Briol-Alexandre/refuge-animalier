<template>
    <form class="grid grid-cols-2 gap-x-4 gap-y-2" @submit.prevent="handleSubmit">
        <p class="col-span-full title">
            Modifier la fiche de l'adoption
        </p>
        <div class="flex flex-col">
            <label for="adopter">Choisir un adoptant</label>
            <multiselect id="adopter" :options="adopters" track-by="name" label="name" v-model="selectedAdopter"
                         placeholder="Choisir un adoptant" @select="handleAdopterChange">
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
            <multiselect
                id="animal"
                :options="filteredAnimals"
                track-by="name"
                label="name"
                v-model="selectedAnimal"
                placeholder="Choisir un animal"
                @select="handleAnimalChange"
            >
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
                v-model="formAdoption.status"
                id-name="status"
                label="Statut de l'adoption"
            >
                <option value="">--Choisir un statut--</option>
                <option v-for="statu in status" :value="statu.label">{{ statu.label }}</option>
            </Select>
            <InputError :message="formAdoption.errors.status"></InputError>
        </div>
        <div class="flex justify-between col-span-full gap-4">
            <button @click.prevent="$emit('closeEditModal')" class="underline hover:cursor-pointer hover:no-underline">
                Annuler
            </button>
            <button class="button-light" type="submit">Modifier</button>
        </div>
    </form>
</template>

<script>
import InputError from '@/components/InputError.vue';
import Multiselect from 'vue-multiselect';
import { useForm } from '@inertiajs/vue3';
import { useToasterStore } from '@/stores/useToasterStore.js';
import Select from '@/components/widget/form/Select.vue';
import { Button } from '@/components/ui/button/index.js';
import { update as adoption_update } from '@/actions/App/Http/Controllers/AdoptionsController.js';

export default {
    name: '',
    components: { Button, Select, Multiselect, InputError },
    props: ['adoption', 'animals', 'adopters', 'status', 'adoptions'],

    data() {
        return {
            formAdoption: useForm({
                animal_id: '',
                adopter_id: '',
                status: '',
                adoption_date: '',
                note: {
                    title: '',
                    content: ''
                }
            }),
            toast: useToasterStore(),
            selectedAnimal: null,
            selectedAdopter: null,
            selectedAdoption: null
        };
    },
    mounted() {
        if (this.adoption && this.adoption.animal_id) {
            this.selectedAnimal = this.animals.find(animal => animal.id === this.adoption.animal_id);
            this.selectedAdopter = this.adopters.find(adopter => adopter.id === this.adoption.adopter_id);

            this.formAdoption.animal_id = this.adoption.animal_id;
            this.formAdoption.adopter_id = this.adoption.adopter_id;
            this.formAdoption.adoption_date = this.adoption.adoption_date;
            this.formAdoption.status = this.adoption.status;
        }
    },
    computed: {
        filteredAnimals() {
            return this.animals.filter((animal) => {
                    return animal.status === 'available' || animal.id === this.formAdoption.animal_id;
                }
            );
        }
    },

    methods: {
        adoption_update,
        handleSubmit() {
            this.formAdoption.put(adoption_update(this.adoption.id), {
                onSuccess: ()=>{
                    this.toast.success({text:'L‘adoption a bien été mise à jour'});
                    this.$emit('updated');
                }
            });
        },
        handleAdopterChange() {
            this.formAdoption.adopter_id = this.selectedAdopter?.id;
        },
        handleAnimalChange() {
            this.formAdoption.animal_id = this.selectedAnimal?.id;
        },
    }
};
</script>

<style>

</style>
