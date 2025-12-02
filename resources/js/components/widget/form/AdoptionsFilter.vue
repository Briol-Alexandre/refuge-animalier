<template>
    <div class="grid grid-cols-2 gap-x-4 gap-y-2">
        <p class="title col-span-full !mb-0">
            Filtres
        </p>
        <InputLabel id-name="adopter" type="text" placeholder="Élise">
            Nom de l'adoptant
        </InputLabel>

        <InputLabel id-name="animal" type="text" placeholder="Moka">
            Nom de l'animal
        </InputLabel>

        <Select id-name="status" label="Statut de l'adoption">
            <option value="">--Choisir un statut--</option>
            <option value="pending">En traitement</option>
            <option value="accepted">Acceptée</option>
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
