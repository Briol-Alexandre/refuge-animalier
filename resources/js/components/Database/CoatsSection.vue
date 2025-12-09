<template>
    <div class="border rounded-lg bg-white p-2 overflow-y-scroll">
        <div class="flex justify-between items-center mb-2">
            <p class="font-atten font-bold text-2xl">Pelages</p>
            <button class="hover:cursor-pointer underline" @click="handleCreateModal">+ Ajouter un pelage
            </button>
        </div>
        <ul class="flex flex-col gap-2">
            <li class="p-2 border rounded-lg flex justify-between" v-for="coat in coats">
                {{ coat.name }}
                <div class="flex item-center gap-2">
                    <button @click="openModal(coat)" class="hover:cursor-pointer">
                        <Edit />
                    </button>
                    <button class="hover:cursor-pointer" @click="handleDeleteModal(coat)">
                        <Delete />
                    </button>
                </div>
            </li>
        </ul>
    </div>
    <Teleport to="body">
        <Modal :condition="isModalOpen" @close="openModal" index="z-30" modal-classes="max-w-[500px]">
            <p class="title">Modifier le pellage</p>
            <form @submit.prevent="submit" class="flex flex-col gap-4">
                <div class="grid grid-cols-1 gap-4">
                    <div class="flex flex-col h-full">
                        <label for="name">
                            Nom du pellage
                        </label>
                        <input type="text" v-model="form.name"
                               class="p-2 bg-white border-2 border-main-yellow rounded-lg">
                        <InputError :message="form.errors.name" />
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="button-light">
                        Modifier l'élément
                    </button>
                </div>
            </form>
        </Modal>
        <Modal :condition="isCreateModalOpen" @close="handleCreateModal" index="z-30"
               modal-classes="max-w-[500px]">
            <form class="grid grid-cols-1 gap-4" @submit.prevent="submitCreate">
                <p class="col-span-full title !mb-0">
                    Créer une espèce
                </p>
                <div class="flex flex-col h-full">
                    <label for="name">Nom de l'espèce</label>
                    <input
                        id="name"
                        name="name"
                        v-model="form.name"
                        placeholder="Ex. Chihuahua"
                        class="p-2 bg-white border-2 border-main-yellow rounded-lg"
                    >
                    <InputError :message="form.errors.name" />
                </div>
                <button type="submit" class="button-light ml-auto">Créer l'espèce</button>
            </form>
        </Modal>
        <Modal
            @close="handleDeleteModal"
            :condition="isDeleteModalOpen"
            index="z-30"
            modal-classes="w-fit"
            close-btn-classes="!top-5 !right-5"
        >
            <p>Voulez-vous vraiment supprimer : </p>
            <p class="font-bold">{{ this.modelToEdit?.name }}</p>
            <div class="flex justify-between gap-2 mt-6">
                <button class="underline hover:cursor-pointer" @click="handleDeleteModal">Annuler</button>
                <button class="text-red-600 underline hover:cursor-pointer" @click="deleteSpecie">
                    Supprimer
                </button>
            </div>
        </Modal>
    </Teleport>
</template>

<script>
import { Button } from '@/components/ui/button/index.js';
import Edit from '@/components/svgs/Edit.vue';
import Delete from '@/components/svgs/Delete.vue';
import InputError from '@/components/InputError.vue';
import Input from '../ui/input/Input.vue';
import Modal from '@/components/widget/Modal.vue';
import { useToasterStore } from '@/stores/useToasterStore.js';
import { useForm, usePage } from '@inertiajs/vue3';
import { destroy, store, update } from '@/actions/App/Http/Controllers/CoatsController';

export default {
    name: '',
    components: { Modal, Input, InputError, Delete, Edit, Button },
    props: ['coats'],

    data() {
        return {
            toast: useToasterStore(),
            isModalOpen: false,
            isCreateModalOpen: false,
            isDeleteModalOpen: false,
            modelToEdit: '',
            form: useForm({
                name: ''
            }),
            page: usePage()
        };
    },

    methods: {
        openModal(el) {
            this.isModalOpen = !this.isModalOpen;
            this.modelToEdit = el;
            this.form = useForm({
                name: this.modelToEdit.name
            });
        },
        handleCreateModal() {
            this.isCreateModalOpen = !this.isCreateModalOpen;
            this.form = useForm({
                name: ''
            });
        },
        handleDeleteModal(el) {
            this.isDeleteModalOpen = !this.isDeleteModalOpen;
            this.modelToEdit = el;
            this.form = useForm({
                name: this.modelToEdit.name
            });
        },
        submitCreate() {
            this.form.post(store(), {
                onSuccess: (page) => {
                    this.toast.success({ text: 'Pelage créé avec succès !' });
                    this.form.reset();
                    this.isCreateModalOpen = false;
                },
                onError: (errors) => {
                    this.toast.success({ text: 'Une erreur est apparue lors de la création' });
                }
            });
        },
        submit() {
            this.form.patch(update(this.modelToEdit.id), {
                    onSuccess: (page) => {
                        this.toast.success({ text: 'Pelage modifié avec succès !' });
                        this.form.reset();
                        this.isModalOpen = false;
                    },
                    onError: (errors) => {
                        this.toast.success({ text: 'Une erreur est apparue lors de la modification' });
                    }
                }
            );
        },
        deleteSpecie() {
            this.form.delete(destroy(this.modelToEdit.id), {
                    onSuccess: (page) => {
                        this.toast.success({ text: 'Pelage supprimé avec succès !' });
                        this.form.reset();
                        this.isDeleteModalOpen = false;
                    },
                    onError: (errors) => {
                        this.toast.success({ text: 'Une erreur est apparue lors de la modification' });
                    }
                }
            );
        }
    }
};
</script>

<style>

</style>
