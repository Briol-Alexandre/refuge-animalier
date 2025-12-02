<template>
    <div class="grid grid-cols-2 gap-x-4 gap-y-2">
        <p class="title col-span-full !mb-0">
            Filtres
        </p>
        <Select id-name="specie" label="Type d‘animal">
            <option value="">--Choisir une espèce--</option>
            <option value="dog">Chien</option>
            <option value="cat">Chat</option>
        </Select>

        <Select id-name="breed" label="Race de l‘animal">
            <option value="">--Choisir une race--</option>
            <option value="golden">Golden</option>
            <option value="chihuahua">Chihuahua</option>
        </Select>

        <Select id-name="coat" label="Pelage de l‘animal">
            <option value="">--Choisir un pelage--</option>
            <option value="golden">Noir</option>
            <option value="chihuahua">Blanc</option>
        </Select>

        <InputLabel id-name="date" type="date" placeholder="DD/MM/AAAA">
            Date de naissance de l'animal
        </InputLabel>

        <Select id-name="sexe" label="Sexe de l‘animal">
            <option value="">--Choisir un sexe--</option>
            <option value="male">Mâle</option>
            <option value="female">Femelle</option>
        </Select>

        <Select id-name="vaccine" label="Vaccins">
            <option value="">--Choisir une option--</option>
            <option value="uptodate">À jour</option>
            <option value="todo">À faire</option>
        </Select>

        <Select id-name="status" label="Statut">
            <option value="">--Choisir un statut--</option>
            <option value="available">Disponible</option>
            <option value="cure">En soins</option>
        </Select>
        <div class="flex items-center col-span-full justify-end gap-4">
            <button>
                Réinitialiser
            </button>
            <button class="button-light mb-0">
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
  name: "",
    components: { Button, Select, InputLabel },
  props: [],

  data() {
    return {

    }
  },

  methods: {

  }
}
</script>

<style>

</style>
