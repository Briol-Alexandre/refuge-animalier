<template>
    <Link :href="href" class="flex gap-2 p-4 hover:bg-main-yellow-opacity/60 rounded-lg" :class="active">
        <slot/>
        {{title}}
    </Link>
</template>

<script>
import Dashboard from '@/components/svgs/Dashboard.vue';
import { Link } from '@inertiajs/vue3';

export default {
  name: "",
    components: { Link, Dashboard },
  props: ['active', 'title','href'],

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
