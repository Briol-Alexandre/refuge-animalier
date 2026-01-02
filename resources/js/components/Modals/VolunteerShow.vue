<template>
    <div class="grid grid-cols-3 gap-5">
        <img :src="`/${volunteer.avatar}`" :alt="`Photo de ${volunteer.name}`"
             class="w-full h-full object-cover mt-2 rounded-lg" />
        <div class="col-span-2 self-center">
            <div class="mb-2 flex gap-4 items-center">
                <h2 class="text-3xl font-atten font-black">{{ volunteer.name }}</h2>
            </div>
            <dl class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <dt class="font-bold">Email&nbsp;:</dt>
                    <dd>{{ volunteer.email }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Téléphone&nbsp;:</dt>
                    <dd>{{ volunteer.tel }}</dd>
                </div>
            </dl>
            <div>
                <p class="font-atten text-2xl font-black mb-2 mt-4">Permissions</p>
                <ul class="flex gap-2">
                    <li v-for="permission in volunteer.permissions"
                        class="text-sm bg-main-blue-opacity rounded-full px-1 py-px">{{ permission.name }}
                    </li>
                </ul>
            </div>
        </div>
        <ScheduleTable :volunteer="schedule" />
        <div class="col-span-full flex justify-around">
            <button class="button-dark" @click="handleDeleteModal">Supprimer le bénévole</button>
            <button class="button-light" @click="handleEditModal">Modifier le bénévole</button>
        </div>
    </div>
    <Teleport to="body">
        <Modal :condition="isEditModalOpen" @close="handleEditModal" index="z-30">
            <VolunteerEditForm :volunteer="volunteer" :permissions="permissions" @updated="handleEditModal; $emit('updated')"/>
        </Modal>
        <Modal
            @close="handleDeleteModal"
            :condition="isDeleteModalOpen"
            index="z-30"
            modal-classes="w-fit"
            close-btn-classes="!top-5 !right-5"
        >
            <p>Voulez-vous vraiment archiver : </p>
            <p class="font-bold">{{ this.volunteer?.name }}</p>
            <div class="flex justify-between gap-2 mt-6">
                <button class="underline hover:cursor-pointer" @click="handleDeleteModal">Annuler</button>
                <button class="text-red-600 underline hover:cursor-pointer" @click="handleDeleteSubmit">
                    Supprimer
                </button>
            </div>
        </Modal>
    </Teleport>
</template>

<script>
import ScheduleTable from '@/components/widget/tables/ScheduleTable.vue';
import Modal from '@/components/widget/Modal.vue';
import VolunteerEditForm from '@/components/widget/form/VolunteerEditForm.vue';
import { Button } from '@/components/ui/button/index.js';
import { useForm } from '@inertiajs/vue3';
import { useToasterStore } from '@/stores/useToasterStore.js';
import {destroy as delete_volunteer} from '@/actions/App/Http/Controllers/UsersController.js'
export default {
    components: { Button, ScheduleTable, Modal, VolunteerEditForm },
    props: ['volunteer', 'schedule', 'permissions'],
    data() {
        return {
            isEditModalOpen: false,
            isDeleteModalOpen: false,
            deleteForm: useForm({
                'id': this.volunteer.id
            }),
            toast: useToasterStore(),
        };
    },

    methods: {
        delete_volunteer,
        handleEditModal() {
            this.isEditModalOpen = !this.isEditModalOpen;
        },
        handleDeleteModal(){
            this.isDeleteModalOpen = !this.isDeleteModalOpen;
        },
        handleDeleteSubmit() {
            this.deleteForm.delete(delete_volunteer(this.deleteForm.id), {
                onSuccess: () => {
                    this.toast.success({text: 'Bénévole supprimé avec succès'});
                    this.isDeleteModalOpen = false;
                },
                onError: () => {
                    this.toast.error({text:'Une erreur est survenue'})
                }
            })
        },
        getImagesSrc(imageData) {
            if (!imageData) return [];
            const parsed = typeof imageData === 'string'
                ? JSON.parse(imageData)
                : imageData;
            return Object.keys(parsed);
        },
    }
};
</script>
<style scoped>
th {
    background: rgba(73, 73, 73, 0.1);
}

table * {
    padding: 10px;
    border: 1px var(--color-softGray) solid;
}
</style>
