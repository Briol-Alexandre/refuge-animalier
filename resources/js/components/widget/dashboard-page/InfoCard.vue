<template>
    <article :aria-labelledby="'card-title-'.aria" class="w-full h-full" :class="gridPosition">
        <div
            class="key-card bg-white border border-softGray rounded-2xl flex items-center justify-center py-2.5 max-xs:mt-5 h-full gap-4"

        >
            <div class="w-14 h-14 flex items-center justify-center rounded-full" :class="opacityColor">
                <slot/>
            </div>
            <div class="flex flex-col">
                <b class="font-atten text-xl font-black leading-tight" :class="color">{{ number }}</b>
                <h2 class="text-sm text-text leading-tight" :id="'card-title-'.aria">
                    {{ title }}
                </h2>
            </div>
        </div>
    </article>
</template>

<script>
import Hearth from '@/components/svgs/Hearth.vue';

export default {
  name: "",
    components: { Hearth },
  props: ['aria','opacityColor', 'color', 'title', 'number', 'gridPosition'],

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
