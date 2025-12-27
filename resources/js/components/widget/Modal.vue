<template>
    <Transition
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        enter-active-class="transition-opacity duration-300"
        leave-active-class="transition-opacity duration-200"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="condition"
            @keydown.esc="closeModal"
            @click.self="closeModal"
            class="absolute w-screen h-screen bg-softGray/30 backdrop-blur-xs top-0 left-0"
            :class="index"
        >
            <div
                class="absolute top-1/2 left-1/2 -translate-1/2 bg-white rounded-2xl shadow-sm p-10 w-3/4"
                :class="modalClasses"
            >
                <button
                    @click="closeModal"
                    class="absolute right-10 top-10 hover:cursor-pointer"
                    :class="closeBtnClasses"
                >
                    <Close />
                </button>
                <slot />
            </div>
        </div>
    </Transition>
</template>

<script>
import Close from '@/components/svgs/Close.vue';

export default {
    name: 'Modal',
    components: { Close },
    props: ['condition', 'index', 'modalClasses', 'closeBtnClasses'],
    watch: {
        condition(isOpen) {
            if (isOpen) {
                this.$nextTick(() => {
                    const appElement = document.getElementById('app'); // ou votre élément racine
                    if (appElement) {
                        appElement.setAttribute('inert', '');
                    }
                });
            } else {
                const appElement = document.getElementById('app');
                if (appElement) {
                    appElement.removeAttribute('inert');
                }
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit('close');
        }
    },
};
</script>
