<template>
    <ul class="flex flex-col gap-2">
        <StatistiqueCard v-for="pdf in exports.exportList" :title="pdf.name" :route="pdf.url" />
    </ul>
</template>

<script>
import StatistiqueCard from '@/components/widget/dashboard-page/StatistiqueCard.vue';
import Download from '@/components/svgs/Download.vue';
import { useExportsStore } from '@/stores/exportsStore.js';

export default {
    name: '',
    components: { Download, StatistiqueCard },
    props: [],

    data() {
        return {
            exports: useExportsStore()
        };
    },

    methods: {
        parsePdf() {
            return e;
        }
    }
};
</script>

<style>

</style>
