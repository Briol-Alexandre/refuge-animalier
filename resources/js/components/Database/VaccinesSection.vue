<template>
    <div class="border rounded-lg bg-white p-2 overflow-y-scroll">
        <div class="flex justify-between items-center mb-2">
            <p class="font-atten font-bold text-2xl">Vaccins</p>
            <button class="hover:cursor-pointer underline" @click="handleCreateModal">+ Ajouter un vaccin
            </button>
        </div>
        <ul class="flex flex-col gap-2">
            <li class="p-2 border rounded-lg flex justify-between" v-for="vaccine in vaccines">
                <p>
                    {{ vaccine.name }}
                    <small class="text-xs font-bold">
                        ({{ vaccine.species.name }})
                    </small>
                </p>
                <div class="flex item-center gap-2">
                    <button @click="openModal(vaccine)" class="hover:cursor-pointer">
                        <Edit/>
                    </button>
                    <button class="hover:cursor-pointer" @click="handleDeleteModal(vaccine)">
                        <Delete/>
                    </button>
                </div>
            </li>
        </ul>
    </div>
    <Teleport to="body">
        <Modal :condition="isModalOpen" @close="openModal" index="z-30" modal-classes="max-w-[500px]">
            <p class="title">Modifier le vaccin</p>
            <form @submit.prevent="submit" class="flex flex-col gap-4">
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col h-full">
                        <label for="name">
                            Nom du vaccin
                        </label>
                        <input type="text" v-model="form.name"
                               class="p-2 bg-white border-2 border-main-yellow rounded-lg">
                        <InputError :message="form.errors.name"/>
                    </div>
                    <Select id-name="specie_id" label="Espèce liée" v-model="form.specie_id">
                        <option value="">--Choisir une espèce--</option>
                        <option v-for="specie in species" :value="specie.id">{{ specie.name }}</option>
                    </Select>
                </div>
                <InputError :message="form.errors.specie_id"/>

                <div class="flex justify-end">
                    <button type="submit" class="button-light">
                        Modifier l'élément
                    </button>
                </div>
            </form>
        </Modal>
        <Modal :condition="isCreateModalOpen" @close="handleCreateModal" index="z-30"
               modal-classes="max-w-[500px]">
            <form class="grid grid-cols-2 gap-4" @submit.prevent="submitCreateBreed">
                <p class="col-span-full title !mb-0">
                    Créer un vaccin
                </p>
                <div class="flex flex-col h-full">
                    <label for="name">Nom du vaccin</label>
                    <input
                        id="name"
                        name="name"
                        v-model="form.name"
                        placeholder="Ex. Chihuahua"
                        class="p-2 bg-white border-2 border-main-yellow rounded-lg"
                    >
                    <InputError :message="form.errors.name"/>
                </div>
                <Select id-name="specie_id" label="Espèce liée" v-model="form.specie_id">
                    <option value="">--Choisir une espèce--</option>
                    <option v-for="specie in species" :value="specie.id">{{ specie.name }}</option>
                </Select>
                <InputError :message="form.errors.specie_id"/>


                <button type="submit" class="button-light ml-auto">Créer le vaccin</button>
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
                <button class="text-red-600 underline hover:cursor-pointer" @click="deleteElement">
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
import Select from '@/components/widget/form/Select.vue';
import { useToasterStore } from '@/stores/useToasterStore.js';
import { useForm, usePage } from '@inertiajs/vue3';
import { destroy, store, update } from '@/actions/App/Http/Controllers/VaccinesController';

export default {
  name: "",
    components: { Select, Modal, Input, InputError, Delete, Edit, Button },
  props: ['vaccines', 'species'],

  data() {
      return {
          toast: useToasterStore(),
          isModalOpen: false,
          isCreateModalOpen: false,
          isDeleteModalOpen: false,
          modelToEdit: '',
          form: useForm({
              name: '',
              specie_id: ''
          }),
          page:usePage()
      }
  },

  methods: {
      update,
      store,
      destroy,
      openModal(el) {
          this.isModalOpen = !this.isModalOpen;
          this.modelToEdit = el;
          this.form = useForm({
              name: this.modelToEdit.name,
              specie_id: this.modelToEdit.species.id
          });
      },
      handleCreateModal() {
          this.isCreateModalOpen = !this.isCreateModalOpen;
          this.form = useForm({
              name: '',
              specie_id: ''
          });
      },
      handleDeleteModal(el) {
          this.isDeleteModalOpen = !this.isDeleteModalOpen;
          this.modelToEdit = el;
          this.form = useForm({
              name: this.modelToEdit.name,
              specie_id: this.modelToEdit.specie.id
          });
      },
      submitCreateBreed() {
          this.form.post(store(), {
              onSuccess: (page) => {
                  this.toast.success({text: 'Race créée avec succès !'});
                  this.form.reset();
                  this.isCreateModalOpen = false;
              },
              onError: (errors) => {
                  this.toast.success({text: 'Une erreur est apparue lors de la création'});
              }
          });
      },
      submit() {
          this.form.patch(update(this.modelToEdit.id), {
                  onSuccess: (page) => {
                      this.toast.success({text: 'Race modifiée avec succès !'});
                      this.form.reset();
                      this.isModalOpen = false;
                  },
                  onError: (errors) => {
                      this.toast.success({text: 'Une erreur est apparue lors de la modification'});
                  }
              }
          );
      },
      deleteElement() {
          this.form.delete(destroy(this.modelToEdit.id), {
                  onSuccess: (page) => {
                      this.toast.success({text: 'Race supprimée avec succès !'});
                      this.form.reset();
                      this.isDeleteModalOpen = false;
                  },
                  onError: (errors) => {
                      this.toast.success({text: 'Une erreur est apparue lors de la modification'});
                  }
              }
          )
      }
  }
}
</script>

<style>

</style>
