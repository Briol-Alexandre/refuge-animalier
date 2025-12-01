<template>
    <ul class="flex flex-col gap-2">
        <StatistiqueCard title="Mars 2024" :route="show(1)"/>
        <StatistiqueCard title="Avril 2024" :route="show(1)"/>
        <StatistiqueCard title="Mai 2024" :route="show(1)"/>
    </ul>
</template>

<script>
import StatistiqueCard from '@/components/widget/dashboard-page/StatistiqueCard.vue';
import Download from '@/components/svgs/Download.vue';
import { router } from '@inertiajs/vue3';
import { show } from '@/actions/App/Http/Controllers/StatistiquesController';

export default {
  name: "",
    components: { Download, StatistiqueCard },
  props: [],

  data() {
    return {

    }
  },

  methods: {
      show,
      router() {
          return router
      }

  }
}
</script>

<style>

</style>
