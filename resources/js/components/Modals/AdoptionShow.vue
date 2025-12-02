<template>
    <div class="grid grid-cols-2 gap-y-10">
        <div>
            <p class="font-atten text-2xl font-black">Adoptant</p>
            <dl>
                <div class="flex gap-2">
                    <dt class="font-medium">Nom&nbsp;:</dt>
                    <dd>{{ adoption.adopter }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-medium">Email&nbsp;:</dt>
                    <dd>email@domain.com</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-medium">Téléphone&nbsp;:</dt>
                    <dd>04 44 44 44</dd>
                </div>
            </dl>

        </div>
        <div>
            <p class="font-atten text-2xl font-black">Animal</p>
            <dl>
                <div class="flex gap-2">
                    <dt>Nom&nbsp;:</dt>
                    <dd>{{ adoption.animal }}</dd>
                </div>
            </dl>
        </div>
        <div>
            <p class="font-atten text-2xl font-black">Status de l'adoption</p>
            <p>En cours</p>
        </div>
        <div class="flex flex-col">
            <div class="flex justify-between items-center">
                <p class="font-atten text-2xl font-black">Notes</p>
                <button class="underline hover:cursor-pointer" @click="handleModal">
                    + Ajouter une note
                </button>
            </div>
            <ul class="list-disc list-inside">
                <li v-for="(note, i) in visibleNotes" :key="i">
                    <a href="" class="hover:underline">{{ note }}</a>
                </li>
            </ul>
            <button
                class="text-end underline self-end hover:cursor-pointer"
                @click="showMore">
                <span v-if="!showAll">Afficher plus</span>
                <span v-else>Afficher moins</span>
            </button>
        </div>
        <div class="col-span-full">
            <p class="font-atten text-2xl font-black">Prise de contact <small>(formulaire rempli par l'adoptant)</small></p>
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut la</p>

        </div>
        <div class="col-span-full flex justify-center gap-4">
            <button class="button-dark">Archiver la fiche</button>
            <button class="button-light">Modifier la fiche</button>
        </div>
    </div>
    <Teleport to="body">
        <Modal :condition="isNoteModalOpen" index="z-30" @close="handleModal">
            <form action="#" method="post" class="flex flex-col justify-center gap-4">
                <p class="title col-span-full !mb-0">Ajouter une nouvelle note</p>
                <InputLabel id-name="title" placeholder="Note">
                    Titre de la note
                </InputLabel>
                <TextareaLabel id-name="content" placeholder="Entrez la description ici…">
                    Contenu de la note
                </TextareaLabel>
                <button class="button-light self-end">
                    Ajouter la note
                </button>
            </form>
        </Modal>
    </Teleport>
</template>

<script>
import Modal from '@/components/widget/Modal.vue';
import InputLabel from '@/components/widget/form/InputLabel.vue';
import TextareaLabel from '@/components/widget/form/TextareaLabel.vue';

export default {
    name: '',
    props: ['adoption'],
    components: {
        Modal,
        InputLabel,
        TextareaLabel
    },

    data() {
        return {
            notes: [
                'Note 1',
                'Note 2',
                'Note 3',
                'Note 4',
                'Note 5',
                'Note 6',
                'Note 7',
                'Note 8'
            ],
            showAll: false,
            isNoteModalOpen: false
        };
    },
    computed: {
        visibleNotes() {
            return this.showAll ? this.notes : this.notes.slice(0, 3);
        }
    },

    methods: {
        showMore() {
            this.showAll = !this.showAll;
        },
        handleModal() {
            this.isNoteModalOpen = !this.isNoteModalOpen;
        }
    }
};
</script>

<style>

</style>
