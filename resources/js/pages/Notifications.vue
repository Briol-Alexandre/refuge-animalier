<template>
    <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
        <div class="mt-14 mb-14 col-start-2 col-span-8 row-start-1 flex justify-between items-center">
            <h1 class="title !mb-0">
                Vos notifications
            </h1>
        </div>
        <section aria-labelledby="emergency"
                 class="col-start-2 col-span-8 bg-main-red-opacity rounded-2xl row-start-2 row-span-2 !mb-0 p-4 border">
            <div class="flex justify-between mb-4">
                <div class="flex items-center gap-2 font-atten">
                    <span class=" font-black text-2xl">!</span>
                    <h3 id="emergency" class="text-2xl font-bold">Vos urgences</h3>
                </div>
                <button class="underline hover:cursor-pointer" @click="allRead(urgents)">Tout marquer comme
                    lu
                </button>
            </div>
            <div class="overflow-y-scroll h-[80%]">
                <ul class="flex flex-col gap-4">
                    <li v-for="urgent in urgents"
                        class="bg-white p-2 py-3 rounded-lg flex justify-between items-center relative">
                        <p class="notif_title flex-1" :class="!urgent.read ? 'font-bold': 'pl-3'">
                            <span v-if="!urgent.read" class="font-black">•</span>
                            {{ urgent.title }}
                        </p>
                        <span class="self-end mr-4 text-gray-500">
                                {{ dateFormat(urgent.created_at) }}
                            </span>
                        <span @click="handleShowActions(urgent.id)" class="hover:cursor-pointer">
                                <More />
                            </span>
                        <div
                            class="absolute top-2 right-2 bg-white p-4 rounded-lg shadow-sm flex flex-col items-start gap-2 z-30"
                            v-if="showActionsId === urgent.id">
                                <span class="absolute top-2 right-2 hover:cursor-pointer"
                                      @click="handleShowActions(null)">
                                    <Close classes="w-3 h-3" />
                                </span>
                            <button class="underline hover:cursor-pointer text-gray-400"
                                    @click="readNotif(urgent)">
                                <span v-if="!urgent.read">
                                    Marquer comme lu
                                </span>
                                <span v-else>
                                    Marquer comme non-lu
                                </span>
                            </button>
                            <button class="underline hover:cursor-pointer text-red-400"
                                    @click="urgentNotif(urgent)"
                            >
                                Retirer des urgences
                            </button>
                            <button class="underline hover:cursor-pointer text-red-400"
                                    @click="handleModal(urgent)"
                            >
                                Supprimer la notification
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <section aria-labelledby="notification"
                 class="col-start-2 col-span-8 bg-softGray/40 rounded-2xl row-start-4 row-span-4 !mb-0 p-4 border">
            <div class="flex justify-between mb-4">
                <div class="flex items-center gap-2 font-atten">
                    <Notifications />
                    <h3 id="" class="text-2xl font-bold">Notifications</h3>
                </div>
                <button class="underline hover:cursor-pointer" @click="allRead(notifications)">Tout marquer comme
                    lu
                </button>
            </div>
            <div class="overflow-y-scroll h-[90%]">
                <ul class="flex flex-col gap-4 h-full">
                    <li v-for="notification in notifications"
                        class="bg-white p-2 py-3 rounded-lg flex justify-between items-center relative">
                        <p class="notif_title flex-1" :class="!notification.read ? 'font-bold': 'pl-3'">
                            <span v-if="!notification.read" class="font-black">•</span>
                            {{ notification.title }}
                        </p>
                        <span class="self-end mr-4 text-gray-500">
                                {{ dateFormat(notification.created_at) }}
                            </span>
                        <span @click="handleShowActions(notification.id)" class="hover:cursor-pointer">
                                <More />
                            </span>
                        <div
                            class="absolute top-2 right-2 bg-white p-4 rounded-lg shadow-sm flex flex-col items-start gap-2 z-30"
                            v-if="showActionsId === notification.id">
                                <span class="absolute top-2 right-2 hover:cursor-pointer"
                                      @click="handleShowActions(null)">
                                    <Close classes="w-3 h-3" />
                                </span>
                            <button class="underline hover:cursor-pointer text-gray-400"
                                    @click="readNotif(notification)">
                                <span v-if="!notification.read">
                                    Marquer comme lu
                                </span>
                                <span v-else>
                                    Marquer comme non-lu
                                </span>
                            </button>
                            <button class="underline hover:cursor-pointer text-red-400"
                                    @click="urgentNotif(notification)"
                            >
                                Ajouter aux urgences
                            </button>
                            <button class="underline hover:cursor-pointer text-red-400"
                                    @click="handleModal(notification)"
                            >
                                Supprimer la notification
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <Teleport to="body">
            <Modal
                @close="closeModal"
                :condition="isModalOpen"
                index="z-30"
                modal-classes="w-fit"
                close-btn-classes="!top-5 !right-5"
            >
                <p>Voulez-vous vraiment supprimer : </p>
                <p class="font-bold">{{ notifToDelete?.title }}</p>
                <div class="flex justify-between gap-2 mt-6">
                    <button class="underline hover:cursor-pointer" @click="closeModal">Annuler</button>
                    <button class="text-red-600 underline hover:cursor-pointer" @click="deleteNotif">
                        Supprimer
                    </button>
                </div>
            </Modal>
        </Teleport>
    </div>
</template>

<script>
import LoggedLayout from '@/layouts/LoggedLayout.vue';
import Modal from '@/components/widget/Modal.vue';
import Notifications from '@/components/svgs/Notifications.vue';
import { useForm } from '@inertiajs/vue3';
import { update } from '@/actions/App/Http/Controllers/NotificationsController.js';
import { destroy } from '@/actions/App/Http/Controllers/NotificationsController.js';
import Close from '@/components/svgs/Close.vue';
import More from '@/components/svgs/More.vue';

export default {
    name: '',
    components: {
        Modal,
        LoggedLayout,
        Notifications,
        Close,
        More
    },
    props: ['notifications', 'urgents'],
    data() {
        return {
            isModalOpen: false,
            isShowModalOpen: false,
            notifToDelete: null,
            showActionsId: null
        };
    },

    methods: {
        handleModal(notification) {
            this.notifToDelete = notification;
            this.isModalOpen = !this.isModalOpen;
        },
        closeModal() {
            this.isModalOpen = false;
        },
        handleShowActions(id) {
            this.showActionsId = this.showActionsId === id ? null : id;
        },
        deleteNotif() {
            const form = useForm();

            form.delete(destroy(this.notifToDelete.id));

            this.closeModal();
        },
        readNotif(notification) {
            const form = useForm({
                read: !notification.read,
                urgent: notification.urgent
            });

            form.put(update(notification.id), {
                onSuccess: () => {
                    notification.read = !notification.read;
                }
            });
        },
        allRead(notifications) {
        },
        urgentNotif(notification) {
            const form = useForm({
                read: notification.read,
                urgent: !notification.urgent
            });

            form.put(update(notification.id), {
                onSuccess: () => {
                    notification.urgent = !notification.urgent;
                }
            });
        },
        dateFormat(date) {
            date = new Date(date);
            return `${date.getDay()}/${date.getMonth()}/${date.getFullYear()}`;
        }

    }
};
</script>

<style scoped>
.notif_title {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

</style>
