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
                        class="bg-white p-2 py-3 rounded-lg flex justify-between items-center relative"
                        @click="handleShowModal(urgent, $event)">
                        <p class="notif_title flex-1" :class="!urgent.read ? 'font-bold': 'pl-3'">
                            <span v-if="!urgent.read" class="font-black">•</span>
                            {{ urgent.title }}
                        </p>
                        <span class="self-center mr-4 text-gray-500">
                                {{ dateFormat(urgent.created_at) }}
                            </span>
                        <span @click.stop="handleShowActions(urgent.id)" class="hover:cursor-pointer py-3">
                                <More />
                            </span>
                        <div
                            class="absolute top-2 right-2 bg-white p-4 rounded-lg shadow-sm flex flex-col items-start gap-2 z-30"
                            v-if="showActionsId === urgent.id">
                                <span class="absolute top-2 right-2 hover:cursor-pointer"
                                      @click.stop="handleShowActions(null)">
                                    <Close classes="w-3 h-3" />
                                </span>
                            <button class="underline hover:cursor-pointer text-gray-400"
                                    @click.stop="readNotif(urgent)">
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
                        class="bg-white p-2 py-3 rounded-lg flex justify-between items-center relative hover:cursor-pointer"
                        @click="handleShowModal(notification, $event)">
                        <p class="notif_title flex-1" :class="!notification.read ? 'font-bold': 'pl-3'">
                            <span v-if="!notification.read" class="font-black">•</span>
                            {{ notification.title }}
                        </p>
                        <span class="self-center mr-4 text-gray-500">
                                {{ dateFormat(notification.created_at) }}
                            </span>
                        <span @click.stop="handleShowActions(notification.id)" class="hover:cursor-pointer py-4">
                                <More />
                            </span>
                        <div
                            class="absolute top-2 right-2 bg-white p-4 rounded-lg shadow-sm flex flex-col items-start gap-2 z-30"
                            v-if="showActionsId === notification.id">
                                <span class="absolute top-2 right-2 hover:cursor-pointer"
                                      @click.stop="handleShowActions(null)">
                                    <Close classes="w-3 h-3" />
                                </span>
                            <button class="underline hover:cursor-pointer text-gray-400"
                                    @click.stop="readNotif(notification)">
                                <span v-if="!notification.read">
                                    Marquer comme lu
                                </span>
                                <span v-else>
                                    Marquer comme non-lu
                                </span>
                            </button>
                            <button class="underline hover:cursor-pointer text-red-400"
                                    @click.stop="urgentNotif(notification)"
                            >
                                Ajouter aux urgences
                            </button>
                            <button class="underline hover:cursor-pointer text-red-400"
                                    @click.stop="handleModal(notification)"
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
            <Modal
                @close="closeShowModal"
                :condition="showAnimal && modelToShow !== null"
                index="z-30"
            >
                <AnimalShow :animal="modelToShow" :status="status" :is-not-show-page="true" @deleted="closeShowModal" />
            </Modal>
            <Modal @close="closeShowModal"
                   :condition="showAdoption && modelToShow !== null">
                <AdoptionShow :adoption="modelToShow" :animal="animalLinked" :adopter="modelToShow.adopter"
                              :is-not-show-page="true" @updated="closeShowModal" />
            </Modal>
            <Modal @close="closeShowModal"
                   :condition="showVolunteer && modelToShow !== null"
            >
                <VolunteerShow :volunteer="modelToShow" :schedule="modelToShow.schedule" :is-not-show-page="true"
                               @accepted="closeShowModal" />
            </Modal>
            <Modal @close="closeShowModal"
                   :condition="isNotificationModalOpen && modelToShow !== null">
                <p class="title">Demande depuis le formulaire</p>
                <dl>
                    <div class="flex justify-between">
                        <div>
                            <dt class="font-bold">De&nbsp;:</dt>
                            <dd>{{ modelToShow.from }}</dd>
                        </div>
                        <div>
                            <dt class="font-bold">Email&nbsp;:</dt>
                            <dd>{{ modelToShow.email }}</dd>
                        </div>
                    </div>
                    <div class="mt-4">
                        <dt class="font-bold">Message&nbsp;:</dt>
                        <dd>{{ modelToShow.message }}</dd>
                    </div>
                    <div class="mt-4 w-full">
                        <a :href="'mailto:' + modelToShow.email" class="button-light mx-auto">
                            Répondre à {{modelToShow.from}}
                        </a>
                    </div>
                </dl>
            </Modal>
        </Teleport>
    </div>
</template>

<script>
import LoggedLayout from '@/layouts/LoggedLayout.vue';
import Modal from '@/components/widget/Modal.vue';
import Notifications from '@/components/svgs/Notifications.vue';
import { useForm } from '@inertiajs/vue3';
import { destroy, update } from '@/actions/App/Http/Controllers/NotificationsController.js';
import Close from '@/components/svgs/Close.vue';
import More from '@/components/svgs/More.vue';
import AnimalShow from '@/components/Modals/AnimalShow.vue';
import axios from 'axios';
import AdoptionShow from '@/components/Modals/AdoptionShow.vue';
import VolunteerShow from '@/components/Modals/VolunteerShow.vue';
import Dump from '@/components/Debug/Dump.vue';

export default {
    name: '',
    components: {
        VolunteerShow,
        AdoptionShow,
        AnimalShow,
        Modal,
        LoggedLayout,
        Notifications,
        Close,
        More,
        Dump
    },
    props: ['notifications', 'urgents', 'status'],
    data() {
        return {
            isModalOpen: false,
            isShowModalOpen: false,
            notifToDelete: null,
            showActionsId: null,
            showAnimal: false,
            showAdoption: false,
            showVolunteer: false,
            modelToShow: null,
            animalLinked: null,
            isNotificationModalOpen: false
        };
    },

    methods: {
        getAnimal(animalId) {
            return this.animals.find(animal => animal.id === animalId);
        },
        getAdopter(adopterId) {
            return this.adopters.find(adopter => adopter.id === adopterId);
        },
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
        closeShowModal() {
            this.showAnimal = false;
            this.showAdoption = false;
            this.showVolunteer = false;
            this.isNotificationModalOpen = false;
            this.modelToShow = null;
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
            return `${date.getDay()}/${date.getMonth() + 1}/${date.getFullYear()}`;
        },
        async handleShowModal(notification, event) {
            event?.stopPropagation();

            if (notification.notifiable_type === 'App\\Models\\Animal') {
                const response = await axios.get(`/api/animals/${notification.notifiable_id}`);
                this.modelToShow = response.data;
                this.showAnimal = true;
            } else if (notification.notifiable_type === 'App\\Models\\Adoption') {
                const response = await axios.get(`/api/adoptions/${notification.notifiable_id}`);
                let datas = response.data;
                this.modelToShow = datas[0];
                this.animalLinked = datas[1];
                this.showAdoption = true;
            } else if (notification.notifiable_type === 'App\\Models\\User') {
                const response = await axios.get(`/api/users/${notification.notifiable_id}`);
                this.modelToShow = response.data;
                this.showVolunteer = true;
            } else if (notification.notifiable_type === 'App\\Models\\Demand') {
                const response = await axios.get(`/api/demands/${notification.notifiable_id}`);
                this.modelToShow = response.data;
                this.isNotificationModalOpen = true;
            }
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
