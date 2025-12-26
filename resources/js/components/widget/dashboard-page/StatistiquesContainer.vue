<template>
    <section aria-labelledby="statistics-title"
             class="border border-softGray rounded-2xl px-4 pb-4 mb-0 flex flex-col gap-4 h-full overflow-y-scroll relative" :class="gridPos">
        <h2 class="font-atten font-medium text-2xl flex gap-2 items-center justify-center sticky  pt-3 top-0 bg-white">
            <Statistiques />
            Statistiques
        </h2>
        <StatistiqueList/>
    </section>
</template>

<script>
import Download from '@/components/svgs/Download.vue';
import Statistiques from '@/components/svgs/Statistiques.vue';
import StatistiqueList from '@/components/widget/dashboard-page/StatistiqueList.vue';

export default {
  name: "",
    components: { Statistiques, Download, StatistiqueList },
  props: ['gridPos'],

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
