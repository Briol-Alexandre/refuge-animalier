<script setup lang="ts">
import type { HTMLAttributes } from 'vue';
import { useVModel } from '@vueuse/core';

const props = defineProps<{
    defaultValue?: string | number
    modelValue?: string | number
    inputClass?: string
    class?: HTMLAttributes['class']
}>();

const emits = defineEmits<{
    (e: 'update:modelValue', payload: string | number): void
}>();

const modelValue = useVModel(props, 'modelValue', emits, {
    passive: true,
    defaultValue: props.defaultValue
});
</script>

<template>
    <input
        v-model="modelValue"
        data-slot="input"
        class="p-2 bg-white border-2 border-main-yellow rounded-lg"
        :class="inputClass"
    >
</template>
