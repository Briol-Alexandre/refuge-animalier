<template>
    <div class="flex flex-col">
        <Label :for="idName">
            {{ label }}
        </Label>
        <select
        :id="idName"
        :name="idName"
        class="p-2 bg-white border-2 border-main-yellow rounded-lg"
        :value="modelValue"
        @change="updateValue($event)"
    >
        <slot />
    </select>
    </div>
</template>

<script>
import { Input } from '@/components/ui/input/index.js';

export default {
    name: '',
    components: { Input },
    props: [
        'idName',
        'label',
        'modelValue'
    ],

    data() {
        return {};
    },

    methods: {
        updateValue(event) {
            this.$emit('update:modelValue', event.target.value);
            this.$emit('change', event);
        }
    }
};
</script>

<style>

</style>
