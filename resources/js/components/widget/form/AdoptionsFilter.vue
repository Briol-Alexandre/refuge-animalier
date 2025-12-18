<template>
    <div class="grid grid-cols-2 gap-x-4 gap-y-2">
        <p class="title col-span-full !mb-0">
            Filtres
        </p>
        <Select id-name="status" label="Statut de l'adoption" class="col-span-full" v-model="currentFilter"
                @change="$emit('filterChange', currentFilter)">
            <option value="">--Choisir un statut--</option>
            <option v-for="s in status" :value="s.value">{{ s.label }}</option>
        </Select>
    </div>
</template>

<script>
import InputLabel from '@/components/widget/form/InputLabel.vue';
import Select from '@/components/widget/form/Select.vue';
import { Button } from '@/components/ui/button/index.js';

export default {
    name: '',
    components: { Button, Select, InputLabel },
    props: ['status', 'modelValue'],

    data() {
        return {
            isFilterDisplayed: false,
            currentFilter: this.modelValue || ''
        };
    },

    watch: {
        modelValue(newVal) {
            this.currentFilter = newVal;
        }
    },

    methods: {}
};
</script>

<style>

</style>
