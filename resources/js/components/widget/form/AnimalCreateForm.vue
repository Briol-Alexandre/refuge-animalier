<template>
    <form action="" method="post" class="grid grid-cols-6 gap-x-4 gap-y-2">
        <p class="col-span-full title">
            Créer la fiche d'un animal
        </p>
        <div class="col-span-2 h-full">
            <InputLabel type="file" id-name="avatar" input-class="hidden"
                        label-class="w-full h-full bg-softGray/50 flex items-center justify-center">
                <div class="text-center flex flex-col items-center">
                    <ImageAdd fill-color="#ECECEC"/>
                    Ajouter une ou <span class="block">plusieurs photos</span>
                </div>
            </InputLabel>
        </div>
        <fieldset class="col-span-4 grid grid-cols-2 gap-x-4 gap-y-2">
            <InputLabel id-name="name" type="text" placeholder="Moka">
                Nom de l'animal
            </InputLabel>

            <Select v-model="specie" id-name="specie" label="Type d‘animal" @change="addElModal">
                <option value="">--Choisir une espèce--</option>
                <option value="add-specie">+ Ajouter une espèce</option>
                <option value="dog">Chien</option>
                <option value="cat">Chat</option>
            </Select>

            <Select v-model="breed" id-name="breed" label="Race de l‘animal" @change="addElModal">
                <option value="">--Choisir une race--</option>
                <option value="add-breed">+ Ajouter une race</option>
                <option value="golden">Golden</option>
                <option value="chihuahua">Chihuahua</option>
            </Select>

            <Select v-model="coat" id-name="coat" label="Pelage de l‘animal" @change="addElModal">
                <option value="">--Choisir un pelage--</option>
                <option value="add-coat">+ Ajouter un pelage</option>
                <option value="golden">Noir</option>
                <option value="chihuahua">Blanc</option>
            </Select>

            <InputLabel id-name="date" type="date" placeholder="DD/MM/AAAA">
                Date de naissance de l'animal
            </InputLabel>

            <Select id-name="sexe" label="Sexe de l‘animal">
                <option value="">--Choisir un sexe--</option>
                <option value="male">Mâle</option>
                <option value="female">Femelle</option>
            </Select>

            <Select v-model="vaccine" id-name="vaccine" label="Vaccins" @change="addElModal">
                <option value="">--Choisir une option--</option>
                <option value="add-vaccine">+ Ajouter une option</option>
                <option value="uptodate">À jour</option>
                <option value="todo">À faire</option>
            </Select>

            <Select v-model="animalStatus" id-name="status" label="Statut" @change="addElModal">
                <option value="">--Choisir un statut--</option>
                <option value="add-status">+ Ajouter une statut</option>
                <option value="available">Disponible</option>
                <option value="cure">En soins</option>
            </Select>
        </fieldset>
        <div class="col-span-full grid grid-cols-2 gap-x-4">
            <TextareaLabel id-name="description" placeholder="Écrivez la description…" input-class="min-h-32">
                Description de l'animal
            </TextareaLabel>
            <TextareaLabel id-name="note" placeholder="Écrivez la note…" input-class="min-h-32">
                Note de l'animal <small>seuls vous et les bénévoles la verront</small>
            </TextareaLabel>
        </div>
        <div class="col-span-full flex justify-between items-center">
            <button class="underline hover:cursor-pointer" @click="openModal">
                Annuler
            </button>
            <button type="submit" class="button-light w-fit">
                Créer la fiche
            </button>
        </div>
    </form>
    <Teleport to="body">
        <Modal :condition="modalToOpen === 'specie'" @close="modalToOpen = ''" index="z-30">
            Modal Espèce
        </Modal>
        <Modal :condition="modalToOpen === 'breed'" @close="modalToOpen = ''" index="z-30">
            Modal Race
        </Modal>
        <Modal :condition="modalToOpen === 'coat'" @close="modalToOpen = ''" index="z-30">
            Modal Pelage
        </Modal>
        <Modal :condition="modalToOpen === 'vaccine'" @close="modalToOpen = ''" index="z-30">
            Modal Vaccin
        </Modal>
        <Modal :condition="modalToOpen === 'status'" @close="modalToOpen = ''" index="z-30">
            Modal Statut
        </Modal>
    </Teleport>
</template>

<script>
import InputLabel from '@/components/widget/form/InputLabel.vue';
import TextareaLabel from '@/components/widget/form/TextareaLabel.vue';
import Select from '@/components/widget/form/Select.vue';
import ImageAdd from '@/components/svgs/ImageAdd.vue';
import {Button} from '@/components/ui/button/index.js';
import Modal from '@/components/widget/Modal.vue';
import { nextTick } from 'vue';

export default {
    name: '',
    components: {Modal, Button, ImageAdd, Select, TextareaLabel, InputLabel},
    props: ['openModal'],

    data() {
        return {
            specie: '',
            breed: '',
            coat: '',
            vaccine: '',
            animalStatus: '',
            modalToOpen: ''
        };
    },

    methods: {
        addElModal() {
            if (this.specie === 'add-specie') {
                this.modalToOpen = 'specie';
                nextTick(()=>{
                    this.specie = '';
                })
            }
            if (this.breed === 'add-breed') {
                this.modalToOpen = 'breed';
                nextTick(()=>{
                    this.breed = '';
                })
            }
            if (this.coat === 'add-coat') {
                this.modalToOpen = 'coat';
                nextTick(()=>{
                    this.coat = '';
                })
            }
            if (this.vaccine === 'add-vaccine') {
                this.modalToOpen = 'vaccine';
                nextTick(()=>{
                    this.vaccine = '';
                })
            }
            if (this.animalStatus === 'add-status') {
                this.modalToOpen = 'status';
                nextTick(()=>{
                    this.status = '';
                })
            }
        }
    }
};
</script>

<style>

</style>
