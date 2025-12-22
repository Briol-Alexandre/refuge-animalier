<template>
    <div class="grid grid-cols-3 gap-5">
        <img :src="volunteer.avatar" :alt="`Photo de ${volunteer.name}`"
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
        <ScheduleTable :volunteer="schedule"/>
    </div>
</template>

<script>
import ScheduleTable from '@/components/widget/tables/ScheduleTable.vue';

export default {
    components: { ScheduleTable },
    props: ['volunteer', 'schedule'],
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
