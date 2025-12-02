<template>
    <form action="" method="post" class="grid grid-cols-2 gap-x-4 gap-y-2">
        <p class="col-span-full title">
            Créer la fiche d'un bénévole
        </p>

        <div class="flex flex-col">
            <InputLabel id-name="name" type="string" placeholder="John Doe">
                Nom complet du bénévole
            </InputLabel>
            <InputLabel id-name="email" type="email" placeholder="john.doe@domain.com">
                Email du bénévole
            </InputLabel>
            <InputLabel id-name="tel" type="tel" placeholder="04 44 44 44 44">
                Numéro de téléphone du bénévole
            </InputLabel>
        </div>
        <fieldset class="flex flex-col">
            <legend class="flex justify-between w-full">
                <span class="font-bold">
                    Permissions
                </span>
                <span class="underline hover:cursor-pointer" @click="handlePermissionModal">
                    + Ajouter une permission
                </span>
            </legend>

            <span v-for="permission in permissions" class="flex gap-2">
                <input type="checkbox" :name="permission.name" :id="permission.id">
                <label :for="permission.id">{{ permission.name }}</label>
            </span>
        </fieldset>
        <button type="submit" class="col-span-2 ml-auto button-light">Ajouter le bénévole</button>
    </form>
    <Teleport to="body">
        <Modal :condition="isPermissionModalOpen" index="z-30" @close="handlePermissionModal" modal-classes="!w-1/2">
            <p class="col-span-full title">
                Ajouter une permission
            </p>
            <InputLabel id-name="name" placeholder="Peut modifier" type="text">
                Nom de la permission
            </InputLabel>
        </Modal>
    </Teleport>
</template>

<script>
import InputLabel from '@/components/widget/form/InputLabel.vue';
import TextareaLabel from '@/components/widget/form/TextareaLabel.vue';
import Select from '@/components/widget/form/Select.vue';
import ImageAdd from '@/components/svgs/ImageAdd.vue';
import { Button } from '@/components/ui/button/index.js';
import Modal from '@/components/widget/Modal.vue';

export default {
    name: '',
    components: { Modal, Button, ImageAdd, Select, TextareaLabel, InputLabel },
    props: ['openModal', 'permissions'],

    data() {
        return {
            isPermissionModalOpen: false,
        };
    },

    methods: {
        handlePermissionModal() {
            this.isPermissionModalOpen = !this.isPermissionModalOpen;
        }
    }
};
</script>

<style>

</style>
