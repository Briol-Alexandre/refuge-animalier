<template>
    <section aria-labelledby="statistics-title"
             class="col-start-8 col-end-10 row-start-4 row-span-4 border border-softGray rounded-2xl p-6 mb-0 flex flex-col gap-4">
        <h2 class="font-atten font-medium text-2xl flex gap-2 items-center justify-center">
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
  props: [],

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
