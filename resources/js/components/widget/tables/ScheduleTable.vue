<template>
    <div class="col-span-full">
        <p class="font-atten text-2xl font-black mb-2 mt-4">Disponibilités</p>
        <table class="w-full text-left">
            <tr>
                <th></th>
                <th v-for="day in days" :key="day.key">{{ day.label }}</th>
            </tr>
            <tr v-for="time in times" :key="time.key">
                <th>{{ time.label }}</th>
                <td v-if="!volunteer" v-for="day in days" :key="`${day.key}-${time.key}`"
                    :class="schedule[day.key][time.key] ? 'bg-green-500/20' : 'bg-red-500/20'">
                    <label class="checkbox-cell">
                        <input
                            class="hidden"
                            type="checkbox"
                            v-model="schedule[day.key][time.key]"
                        />
                        <span class="">{{ schedule[day.key][time.key] ? 'Oui' : 'Non' }}</span>
                    </label>
                </td>
                <td v-else-if="volunteerSchedule" v-for="da in days" :key="`${da.key}-${time.key}-edit`"
                    :class="volunteerSchedule[da.key][time.key] ? 'bg-green-500/20' : 'bg-red-500/20'">
                    <label class="checkbox-cell">
                        <input
                            class="hidden"
                            type="checkbox"
                            v-model="volunteerSchedule[da.key][time.key]"
                        />
                        <span class="">{{ volunteerSchedule[da.key][time.key] ? 'Oui' : 'Non' }}</span>
                    </label>
                </td>
                <td v-else v-for="d in days" :key="`${d.key}-${time.key}-view`"
                    :class="volunteer[d.key][time.key] === '1' ? 'bg-green-500/20' : 'bg-red-500/20'">
                    <span class="">{{ volunteer[d.key][time.key] === '1' ? 'Oui' : 'Non' }}</span>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    name: 'ScheduleTable',
    props: ['modelValue', 'volunteer', 'volunteerSchedule'],
    emits: ['update:modelValue'],

    data() {
        return {
            days: [
                { key: 'monday', label: 'Lundi' },
                { key: 'tuesday', label: 'Mardi' },
                { key: 'wednesday', label: 'Mercredi' },
                { key: 'thursday', label: 'Jeudi' },
                { key: 'friday', label: 'Vendredi' },
                { key: 'saturday', label: 'Samedi' },
                { key: 'sunday', label: 'Dimanche' }
            ],
            times: [
                { key: 'morning', label: 'Matin' },
                { key: 'afternoon', label: 'Après-midi' },
                { key: 'evening', label: 'Soir' }
            ]
        };
    },

    computed: {
        schedule: {
            get() {
                return this.modelValue || this.defaultSchedule();
            },
            set(value) {
                this.$emit('update:modelValue', value);
            }
        },

    },

    methods: {
        defaultSchedule() {
            return {
                monday: { morning: false, afternoon: false, evening: false },
                tuesday: { morning: false, afternoon: false, evening: false },
                wednesday: { morning: false, afternoon: false, evening: false },
                thursday: { morning: false, afternoon: false, evening: false },
                friday: { morning: false, afternoon: false, evening: false },
                saturday: { morning: false, afternoon: false, evening: false },
                sunday: { morning: false, afternoon: false, evening: false }
            };
        }
    }
};
</script>

<style scoped>
th {
    background: rgba(73, 73, 73, 0.1);
}

tr, th, td {
    padding: 10px;
    border: 1px var(--color-softGray) solid;
}

.checkbox-cell {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
}

.checkbox-cell input[type="checkbox"] {
    cursor: pointer;
}
</style>
