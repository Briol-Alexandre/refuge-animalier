<template>
    <LoggedLayout title="Notifications">
        <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
            <div class="mt-14 mb-14 col-start-2 col-span-8 row-start-1 flex justify-between items-center">
                <h1 class="title !mb-0">
                    Vos notifications
                </h1>
            </div>
            <section class="col-start-2 col-span-8 row-start-2 row-span-6 bg-softGray/40 rounded-2xl border p-4 !mb-0 flex flex-col justify-between gap-4">
                <div class="flex justify-between">
                    <div class="flex gap-2">
                        <button
                            class="hover:cursor-pointer bg-white p-1 border rounded-lg border-main-yellow flex items-center gap-2">
                            Mensuel
                            <Filters />
                        </button>
                        <button
                            class="hover:cursor-pointer bg-white p-1 border rounded-lg border-main-yellow flex items-center gap-2">
                            Nov.
                            <Filters />
                        </button>
                    </div>
                    <button
                        class="hover:cursor-pointer bg-white p-1 border rounded-lg border-main-yellow flex items-center gap-2">
                        Exporter le rapport
                        <PDF />
                    </button>
                </div>
                <div class="grid grid-cols-4 grid-rows-6 gap-6 flex-1">
                    <InfoCard v-for="data in datas" :opacity-color="data.colorOpacity" :number="data.model.length ?? 0" :title="data.title" :aria="toCamelCase(data.title)" :color="data.color" :grid-position="data.gridPos">
                        <Hearth v-if="data.svg === 'hearth'" color="#FF6E6E" />
                        <Paw v-if="data.svg === 'paw'" color="#F6C449" classes="w-6"/>
                        <Hand v-if="data.svg === 'hand'" color="#9747FF" classes="w-6" />
                        <User v-if="data.svg === 'user'" color="#47FF56" />
                        <Vaccine v-if="data.svg === 'vaccine'" color="#00D4FF" />
                    </InfoCard>
                    <div class="col-start-1 col-end-4 row-start-2 row-end-7 bg-white rounded-2xl">
                        <!--Graphique-->
                    </div>
                    <div class="col-start-4 col-end-5 row-start-3 row-end-7 bg-white rounded-2xl">
                        <!--Exportation des stats-->
                    </div>

                </div>

            </section>
        </div>
    </LoggedLayout>
</template>

<script>
import LoggedLayout from '@/layouts/LoggedLayout.vue';
import Filters from '@/components/svgs/Filters.vue';
import PDF from '@/components/svgs/PDF.vue';
import InfoCard from '@/components/widget/dashboard-page/InfoCard.vue';
import Vaccine from '@/components/svgs/Vaccine.vue';
import Paw from '@/components/svgs/Paw.vue';
import Hand from '@/components/svgs/Hand.vue';
import Hearth from '@/components/svgs/Hearth.vue';
import User from '@/components/svgs/User.vue';

export default {
    name: '',
    components: {
        User, Hearth, Hand, Paw, Vaccine,
        LoggedLayout,
        Filters,
        PDF,
        InfoCard
    },
    props: ['animals', 'available','adoptions', 'volunteers', 'cures'],
    data() {
        return {
            datas: [
                {
                    model: this.adoptions,
                    color: 'text-main-red',
                    colorOpacity : 'bg-main-red-opacity',
                    title:'Animaux adoptés',
                    gridPos: 'row-start-1 row-span-1',
                    svg: 'hearth',
                },
                {
                    model: this.available,
                    color: 'text-main-yellow',
                    colorOpacity : 'bg-main-yellow-opacity',
                    title:'Animaux disponibles',
                    gridPos: 'row-start-1 row-span-1',
                    svg: 'paw',
                },
                {
                    model: this.volunteers,
                    color: 'text-main-green',
                    colorOpacity : 'bg-main-green-opacity',
                    title:'Bénévoles',
                    gridPos: 'row-start-1 row-span-1',
                    svg: 'user',
                },
                {
                    model: this.animals,
                    color: 'text-main-blue',
                    colorOpacity : 'bg-main-blue-opacity',
                    title:'Animaux recueillis',
                    gridPos: 'row-start-1 row-span-',
                    svg: 'hand',
                },
                {
                    model: this.cures,
                    color: 'text-main-lightBlue',
                    colorOpacity : 'bg-main-lightBlue-opacity',
                    title:'Animaux en soin',
                    gridPos: 'col-start-4 col-span-1 row-start-2 row-span-1',
                    svg: 'vaccine',
                },
            ]
        };
    },

    methods: {
        toCamelCase(string) {
            const tokens = string.split(/[_\s]+/).filter(Boolean);
            return [
                tokens[0],
                ...tokens.slice(1)?.map(word => [word[0].toUpperCase(), word.slice(1)])
            ].flat(1).join('');
        }
    }
};
</script>

<style scoped>

</style>
