<template>
    <div class="grid grid-cols-2 gap-x-4 gap-y-2">
        <p class="title col-span-full !mb-0">
            Filtres
        </p>
        <Select id-name="specie" label="Type d‘animal" v-model="filters.specie">
            <option value="">--Choisir une espèce--</option>
            <option v-for="specie in species" :value="specie.name.toLowerCase()">{{ specie.name }}</option>
        </Select>

        <Select id-name="breed" label="Race de l‘animal" v-model="filters.breed">
            <option value="">--Choisir une race--</option>
            <option v-for="breed in breeds" :value="breed.name.toLowerCase()">{{ breed.name }}</option>
        </Select>

        <Select id-name="coat" label="Pelage de l‘animal" v-model="filters.coat">
            <option value="">--Choisir un pelage--</option>
            <option v-for="coat in coats" :value="coat.name.toLowerCase()">{{ coat.name }}</option>
        </Select>

        <InputLabel id-name="date" type="date" placeholder="DD/MM/AAAA" v-model="filters.date">
            Date de naissance de l'animal
        </InputLabel>

        <Select id-name="sexe" label="Sexe de l‘animal" v-model="filters.sexe">
            <option value="">--Choisir un sexe--</option>
            <option value="male">Mâle</option>
            <option value="female">Femelle</option>
        </Select>

        <Select id-name="vaccine" label="Vaccins" v-model="filters.vaccine">
            <option value="">--Choisir une option--</option>
            <option value="uptodate">À jour</option>
            <option value="todo">À faire</option>
        </Select>

        <Select id-name="status" label="Statut" v-model="filters.status">
            <option value="">--Choisir un statut--</option>
            <option v-for="statu in status" :value="statu.value.toLowerCase()">{{ statu.label }}</option>
        </Select>
        <div class="flex items-center col-span-full justify-end gap-4">
            <button class="underline hover:cursor-pointer" @click="resetAllFields">
                Réinitialiser
            </button>
            <button class="button-light mb-0 hover:cursor-pointer">
                Appliquer
            </button>
        </div>
    </div>
</template>

<script>
import InputLabel from '@/components/widget/form/InputLabel.vue';
import Select from '@/components/widget/form/Select.vue';
import { Button } from '@/components/ui/button/index.js';

export default {
    name: '',
    components: { Button, Select, InputLabel },
    props: ['data', 'breeds', 'coats', 'species', 'status'],

    data() {
        return {
            filters: {
                specie: '',
                breed: '',
                coat: '',
                date: '',
                sexe: '',
                vaccine: '',
                status: '',
            }
        };
    },

    methods: {
        resetAllFields() {
            this.filters = {
                specie: '',
                breed: '',
                coat: '',
                date: '',
                sexe: '',
                vaccine: '',
                status: '',
            }
        }
    }
};
</script>

<style>

</style>
