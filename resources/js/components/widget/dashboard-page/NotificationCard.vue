<template>
    <li class="p-2 border border-softGray rounded-lg flex justify-between items-center">
        {{ title }}
        <span class="flex gap-2">
            <button
                class="group hover:cursor-pointer bg-main-yellow-opacity w-10 rounded-full flex items-center justify-center aspect-square relative">
                    <Eye />
                <span
                    class="hidden group-hover:inline absolute -top-8 left-1/2 -translate-x-1/2 text-sm p-1 bg-main-yellow rounded-md text-white">
                    Voir
                </span>
            </button>
            <button
                class="group hover:cursor-pointer bg-main-red-opacity w-10 rounded-full flex items-center justify-center aspect-square relative">
                <Cross />
                <span
                    class="hidden group-hover:inline absolute -top-8 left-1/2 -translate-x-1/2 text-sm p-1 bg-main-red rounded-md text-white">
                    Supprimer
                </span>
            </button>
        </span>
    </li>
</template>

<script>
import Cross from '@/components/svgs/Cross.vue';
import Eye from '@/components/svgs/Eye.vue';

export default {
    name: '',
    components: { Eye, Cross },
    props: ['title'],

    data() {
        return {};
    },

    methods: {}
};
</script>

<style>

</style>
