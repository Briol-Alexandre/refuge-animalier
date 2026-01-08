<template>
    <div class="w-full h-full relative" :class="gridPosition">
        <div v-if="display" class="absolute top-0 left-0 w-full h-full" @click="$emit('display', display, title)"></div>
        <div
            class="key-card bg-white border border-softGray rounded-2xl flex items-center justify-center py-2.5 max-xs:mt-5 h-full gap-4"

        >
            <div class="w-14 h-14 flex items-center justify-center rounded-full" :class="opacityColor">
                <slot/>
            </div>
            <div class="flex flex-col">
                <b class="font-atten text-xl font-black leading-tight" :class="color">{{ number }}</b>
                <p class="text-sm text-text leading-tight">
                    {{ title }}
                </p>
            </div>
        </div>
    </div>
</template>

<script>
import Hearth from '@/components/svgs/Hearth.vue';

export default {
  name: "",
    components: { Hearth },
  props: ['aria','opacityColor', 'color', 'title', 'number', 'gridPosition', 'display'],

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
