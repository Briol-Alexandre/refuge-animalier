<template>
    <div class="flex flex-col h-full" :class="labelClass">
        <Label :for="idName">
            <slot />
        </Label>
        <Input
            :id="idName"
            :name="idName"
            :type="type"
            :input-class="inputClass"
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
