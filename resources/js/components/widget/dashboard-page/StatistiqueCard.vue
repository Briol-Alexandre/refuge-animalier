<template>
    <li class="border border-softGray rounded-lg p-2 flex justify-between items-center">
        <a @click.prevent="router().visit(route)" class="hover:cursor-pointer" title="Vers la statistique">
            {{title}}
        </a>
        <Download/>
    </li>
</template>

<script>
import Download from '@/components/svgs/Download.vue';
import { router } from '@inertiajs/vue3';

export default {
  name: "",
    components: { Download },
  props: ['title', 'route'],

  data() {
    return {

    }
  },

  methods: {
      router() {
          return router
      }

  }
}
</script>

<style>

</style>
