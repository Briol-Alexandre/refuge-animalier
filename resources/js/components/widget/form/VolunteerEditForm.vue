<template>
    <form class="grid grid-cols-[30%_70%] gap-x-4 gap-y-2" @submit.prevent="handleSubmit" enctype="multipart/form-data">
        <p class="col-span-full title">
            Modifier la fiche de {{ volunteer.name }}
        </p>

        <div class="h-full">
            <div class="flex flex-col h-full">
                <label for="images" class="relative w-full h-full flex items-center justify-center">
                    <div v-if="previewImage"
                         class="absolute top-0 left-0 w-full h-full border-none object-cover grid grid-rows-[80%_20%] gap-2">
                        <img
                            :src="previewImage"
                            class="w-full h-full object-cover col-span-full"
                            alt="" />
                    </div>
                    <img
                        v-else-if="formVolunteer.avatar"
                        :src="formVolunteer.avatar"
                        class="w-full h-full object-cover col-span-full"
                        alt="" />
                    <div v-else class="text-center flex flex-col items-center">
                        <ImageAdd fill-color="#ECECEC" />
                        Ajouter une ou <span class="block">plusieurs photos</span>
                    </div>
                    <InputError :message="formVolunteer.errors.avatar" class="absolute bottom-0" />
                </label>
                <input
                    id="images"
                    type="file"
                    multiple
                    @change="handleFiles($event)"
                    class="hidden"
                />
            </div>
        </div>
        <div class="flex flex-col gap-4">
            <div class="flex flex-col">
                <div class="flex flex-col h-full">
                    <label for="name">
                        Nom complet du bénévole
                    </label>
                    <input id="name" type="text" v-model="formVolunteer.name"
                           class="p-2 bg-white border-2 border-main-yellow rounded-lg" placeholder="Ex. John Doe">
                    <InputError :message="formVolunteer.errors.name" />
                </div>
                <div class="flex flex-col h-full">
                    <label for="email">
                        Email du bénévole
                    </label>
                    <input id="email" type="email" v-model="formVolunteer.email"
                           class="p-2 bg-white border-2 border-main-yellow rounded-lg"
                           placeholder="Ex. john.doe@domain.com">
                    <InputError :message="formVolunteer.errors.email" />
                </div>
                <div class="flex flex-col h-full">
                    <label for="tel">
                        N° de téléphone du bénévole
                    </label>
                    <input id="tel" type="tel" v-model="formVolunteer.tel"
                           class="p-2 bg-white border-2 border-main-yellow rounded-lg" placeholder="Ex. 04 44 44 44 44">
                    <InputError :message="formVolunteer.errors.tel" />
                </div>
            </div>
            <fieldset class="flex flex-col">
                <legend class="flex justify-between w-full">
                <span class="font-bold">
                    Permissions
                </span>
                </legend>

                <div class="grid grid-cols-3 gap-2">
                <span v-for="permission in permissions" class="flex items-center gap-2">
                    <input type="checkbox" :value="permission.id" :id="permission.id"
                           v-model="formVolunteer.permissions">
                    <label :for="permission.id">{{ permission.name }}</label>
                </span>
                </div>
            </fieldset>
        </div>
        <ScheduleTable v-model="formVolunteer.schedule" :volunteer-schedule="formVolunteer.schedule" />
        <button type="submit" class="col-span-2 ml-auto button-light mt-5">Modifier le bénévole</button>
    </form>
</template>

<script>
import InputLabel from '@/components/widget/form/InputLabel.vue';
import TextareaLabel from '@/components/widget/form/TextareaLabel.vue';
import Select from '@/components/widget/form/Select.vue';
import ImageAdd from '@/components/svgs/ImageAdd.vue';
import { Button } from '@/components/ui/button/index.js';
import Modal from '@/components/widget/Modal.vue';
import InputError from '@/components/InputError.vue';
import Input from '../../ui/input/Input.vue';
import { useForm } from '@inertiajs/vue3';
import { update as volunteer_update } from '@/actions/App/Http/Controllers/UsersController.js';
import { useToasterStore } from '@/stores/useToasterStore.js';
import ScheduleTable from '@/components/widget/tables/ScheduleTable.vue';

export default {
    name: '',
    components: { Input, InputError, Modal, Button, ImageAdd, Select, TextareaLabel, InputLabel, ScheduleTable },
    props: ['openModal', 'permissions', 'schedule', 'volunteer'],

    mounted() {
        if (this.volunteer) {
            this.formVolunteer.avatar = this.volunteer.avatar || '';
            this.formVolunteer.name = this.volunteer.name || '';
            this.formVolunteer.email = this.volunteer.email || '';
            this.formVolunteer.tel = this.volunteer.tel || '';
            this.formVolunteer.permissions = this.volunteer.permissions
                ? this.volunteer.permissions.map(p => p.id)
                : [];
            if (this.volunteer.schedule) {
                const parsedSchedule = typeof this.volunteer.schedule === 'string'
                    ? JSON.parse(this.volunteer.schedule)
                    : this.volunteer.schedule;
                this.formVolunteer.schedule = this.convertScheduleToBoolean(parsedSchedule);
            }
        }
    },

    data() {
        return {
            isPermissionModalOpen: false,
            previewImage: '',
            toast: useToasterStore(),
            formVolunteer: useForm({
                avatar: '',
                name: '',
                email: '',
                tel: '',
                permissions: [],
                schedule: {
                    monday: { morning: false, afternoon: false, evening: false },
                    tuesday: { morning: false, afternoon: false, evening: false },
                    wednesday: { morning: false, afternoon: false, evening: false },
                    thursday: { morning: false, afternoon: false, evening: false },
                    friday: { morning: false, afternoon: false, evening: false },
                    saturday: { morning: false, afternoon: false, evening: false },
                    sunday: { morning: false, afternoon: false, evening: false }
                }
            }),
            file: ''
        };
    },

    computed: {
    },

    methods: {
        volunteer_update,
        handleSubmit() {
            this.formVolunteer._method = 'PATCH';
            this.formVolunteer.post(volunteer_update(this.volunteer.id), {
                forceFormData:true,
                onSuccess: () => {
                    this.toast.success({ text: 'Bénévole modifié avec succès !' });
                    this.$emit('updated');
                },
                onError: () => {
                    this.toast.error({ text: 'Une erreur est survenue' });
                }
            });
        },
        handleFiles(event) {
            const file = event.target.files[0];

            if (file) {
                this.file = file;
                this.formVolunteer.avatar = file;
                this.previewImage = URL.createObjectURL(file);
            }
        },
        convertScheduleToBoolean(schedule) {
            const converted = {};
            for (const day in schedule) {
                converted[day] = {};
                for (const time in schedule[day]) {
                    converted[day][time] = schedule[day][time] === '1' || schedule[day][time] === true;
                }
            }
            return converted;
        },
        getImagesSrc(imageData) {
            if (!imageData) return [];
            const parsed = typeof imageData === 'string'
                ? JSON.parse(imageData)
                : imageData;
            return Object.keys(parsed);
        }
    }
};
</script>

<style>

</style>
