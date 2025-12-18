<template>
    <div class="flex gap-2 items-center">
        <label for="status">Status</label>
        <select id="status" name="status" v-model="currentFilter" class="px-2 py-1 bg-white border border-main-yellow rounded-lg" @change="$emit('filterChange', currentFilter)">
            <option value="">Tous</option>
            <option v-for="s in status" :value="s.label">{{ s.label }}</option>
        </select>
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
            currentFilter: this.modelValue || ''
        };
    },

    watch: {
        modelValue(newVal) {
            this.currentFilter = newVal;
        }
    },

    methods: {
    }
};
</script>

<style>

</style>
