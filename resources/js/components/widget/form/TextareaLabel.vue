<template>
    <div class="flex flex-col h-full" :class="labelClass">
        <Label :for="idName">
            <slot />
        </Label>
        <textarea
            :id="idName"
            :name="idName"
            :class="inputClass"
            class="p-2 bg-white border-2 border-main-yellow rounded-lg"
            required
            :placeholder="placeholder"
        />
    </div>
</template>

<script>
import { Input } from '@/components/ui/input/index.js';

export default {
    name: '',
    components: { Input },
    props: ['idName', 'type', 'placeholder','inputClass', 'labelClass'],

    data() {
        return {};
    },

    methods: {}
};
</script>

<style>

</style>
