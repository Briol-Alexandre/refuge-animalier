<template>
    {{ title }}
    <span class="flex-1 mr-2 text-right text-gray-500">{{ date }}</span>
    <span class="flex gap-2">
            <button
                class="group hover:cursor-pointer bg-main-yellow-opacity w-10 rounded-full flex items-center justify-center aspect-square relative">
                    <Eye />
                <span
                    class="hidden group-hover:inline absolute -top-8 left-1/2 -translate-x-1/2 text-sm p-1 bg-main-yellow rounded-md text-white">
                    Voir
                </span>
            </button>
            <button
                class="group hover:cursor-pointer bg-main-red-opacity w-10 rounded-full flex items-center justify-center aspect-square relative"
                @click="handleModal(notif)">
                <Cross />
                <span
                    class="hidden group-hover:inline absolute -top-8 left-1/2 -translate-x-1/2 text-sm p-1 bg-main-red rounded-md text-white">
                    Supprimer
                </span>
            </button>
        </span>
    <Teleport to="body">
        <Modal
            @close="closeModal"
            :condition="isModalOpen"
            index="z-30"
            modal-classes="w-fit"
            close-btn-classes="!top-5 !right-5"
        >
            <p>Voulez-vous vraiment supprimer : </p>
            <p class="font-bold">{{ notif?.title }}</p>
            <div class="flex justify-between gap-2 mt-6">
                <button class="underline hover:cursor-pointer" @click="closeModal">Annuler</button>
                <button class="text-red-600 underline hover:cursor-pointer" @click="deleteNotif">
                    Supprimer
                </button>
            </div>
        </Modal>
    </Teleport>
</template>

<script>
import Cross from '@/components/svgs/Cross.vue';
import Eye from '@/components/svgs/Eye.vue';
import { useForm } from '@inertiajs/vue3';
import { destroy } from '@/actions/App/Http/Controllers/NotificationsController.js';
import Modal from '@/components/widget/Modal.vue';

export default {
    name: '',
    components: { Modal, Eye, Cross },
    props: ['title', 'date', 'notif'],

    data() {
        return {
            isModalOpen: false,
            notifToDelete:null,
        };
    },

    methods: {
        closeModal() {
            this.isModalOpen = false;
        },
        handleModal(notification) {
            this.notifToDelete = notification;
            this.isModalOpen = !this.isModalOpen;
        },
        deleteNotif() {
            const form = useForm();

            form.delete(destroy(this.notifToDelete.id));

            this.closeModal();
        }
    }
};
</script>

<style>

</style>
