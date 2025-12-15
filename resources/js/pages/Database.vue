<template>
    <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
        <h1 class="title mt-14 col-start-2 col-span-full row-start-1">
            {{ title }}
        </h1>
        <div
            class="p-4 col-start-2 col-end-10 border rounded-2xl row-span-6 grid grid-cols-2 grid-rows-2 gap-4 bg-softGray/40">
            <BreedSection :breeds="breeds" :species="species" />
            <SpeciesSection :species="species" />
            <CoatsSection :coats="coats" />
            <VaccinesSection :vaccines="vaccines" :species="species" />
        </div>


    </div>
</template>

<script>
import LoggedLayout from '@/layouts/LoggedLayout.vue';
import StatistiquesContainer from '@/components/widget/dashboard-page/StatistiquesContainer.vue';
import NotificationContainer from '@/components/widget/dashboard-page/NotificationContainer.vue';
import InfoCardContainer from '@/components/widget/dashboard-page/InfoCardContainer.vue';
import Modal from '@/components/widget/Modal.vue';
import InputError from '@/components/InputError.vue';
import Select from '@/components/widget/form/Select.vue';
import Input from '../components/ui/input/Input.vue';
import { Button } from '@/components/ui/button/index.js';
import Edit from '@/components/svgs/Edit.vue';
import Delete from '@/components/svgs/Delete.vue';
import BreedSection from '@/components/Database/BreedSection.vue';
import SpeciesSection from '@/components/Database/SpeciesSection.vue';
import CoatsSection from '@/components/Database/CoatsSection.vue';
import VaccinesSection from '@/components/Database/VaccinesSection.vue';

export default {
    name: '',
    components: {
        Button, Input,
        Select,
        InputError,
        InfoCardContainer,
        NotificationContainer,
        StatistiquesContainer,
        LoggedLayout,
        Modal,
        Edit,
        Delete,
        BreedSection,
        SpeciesSection,
        CoatsSection,
        VaccinesSection
    },
    props: ['breeds', 'species', 'coats', 'vaccines', 'title'],

    data() {
        return {};
    },

    methods: {}
};
</script>

<style>

</style>
