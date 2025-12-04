<template>
    <div @keydown.esc="closeModal" tabindex="0" class="absolute w-screen h-screen bg-softGray/30 backdrop-blur-xs top-0 left-0 " :class="index"
         v-if="condition" >
        <div class="absolute top-1/2 left-1/2 -translate-1/2 bg-white rounded-2xl shadow-sm p-10 w-3/4" :class="modalClasses">

            <button @click="closeModal" class="absolute right-10 top-10 hover:cursor-pointer" :class="closeBtnClasses">
                <Close />
            </button>
            <slot />
        </div>
    </div>
</template>

<script>
import Close from '@/components/svgs/Close.vue';

export default {
    name: '',
    components: { Close },
    props: ['condition', 'index', 'modalClasses', 'closeBtnClasses'],

    data() {
        return {};
    },

    methods: {
        closeModal() {
            this.$emit('close');
        },
    }
};
</script>

<style>

</style>
