<template>
    <div class="col-start-3 col-span-full grid grid-cols-10 grid-rows-8 gap-4 h-screen">
        <div class="mt-14 mb-14 col-start-2 col-span-8 row-start-1 flex justify-between items-center">
            <h1 class="title !mb-0">
                Vos notifications
            </h1>
        </div>
        <section
            class="col-start-2 col-span-8 row-start-2 row-span-6 bg-softGray/40 rounded-2xl border p-4 !mb-0 flex flex-col justify-between gap-4">
            <div class="flex justify-between">
                <div class="flex gap-2">
                    <select
                        class="hover:cursor-pointer bg-white p-1 border rounded-lg border-main-yellow flex items-center gap-2"
                        v-model="base_filter"
                        @change="selected_month=''">
                        <option selected value="monthly">Mensuel</option>
                        <option value="yearly">Annuel</option>
                    </select>
                    <select
                        v-model="selected_year"
                        class="hover:cursor-pointer bg-white p-1 border rounded-lg border-main-yellow flex items-center gap-2">
                        <option value="">--Année--</option>
                        <option :value="year" v-for="year in years" :key="year">{{ year }}</option>
                    </select>
                    <select
                        v-if="base_filter === 'monthly'"
                        v-model="selected_month"
                        class="hover:cursor-pointer bg-white p-1 border rounded-lg border-main-yellow flex items-center gap-2">
                        <option value="">--Mois--</option>
                        <option :value="num + 1" v-for="(month, num) in months" :key="num">{{ month }}</option>
                    </select>
                </div>
                <button
                    class="hover:cursor-pointer bg-white p-1 border rounded-lg border-main-yellow flex items-center gap-2">
                    Exporter le rapport
                    <PDF />
                </button>
            </div>
            <div class="grid grid-cols-4 grid-rows-6 gap-6 flex-1">
                <InfoCard v-for="data in datas" :key="data.title" :opacity-color="data.colorOpacity" :number="data.model ?? 0"
                          :title="data.title" :aria="toCamelCase(data.title)" :color="data.color" :display="data.modelName"
                          :grid-position="data.gridPos" @display="handleDisplayModel">
                    <Hearth v-if="data.svg === 'hearth'" color="#FF6E6E" />
                    <Paw v-if="data.svg === 'paw'" color="#F6C449" classes="w-6" />
                    <Hand v-if="data.svg === 'hand'" color="#9747FF" classes="w-6" />
                    <User v-if="data.svg === 'user'" color="#47FF56" />
                    <Vaccine v-if="data.svg === 'vaccine'" color="#00D4FF" />
                </InfoCard>
                <div class="col-start-1 col-end-4 row-start-2 row-end-6 bg-white rounded-2xl p-4">
                    <p>{{ this.modelTitle }}</p>
                    <Chart type="line" :data="chartData" :options="chartOptions" class="h-full" />
                </div>

                <div class="col-start-4 col-end-5 row-start-2 row-end-6 bg-white rounded-2xl">
                    <!--Exportation des stats-->
                </div>

            </div>

        </section>
    </div>
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
import Chart from 'primevue/chart';
import Dump from '@/components/Debug/Dump.vue';

export default {
    name: '',
    components: {
        User, Hearth, Hand, Paw, Vaccine,
        LoggedLayout,
        Filters,
        PDF,
        InfoCard,
        Chart,
        Dump
    },
    props: ['animals', 'available', 'adoptions', 'volunteers', 'cures', 'animal_model', 'available_model', 'cure_model', 'adoption_model', 'volunteer_model'],
    mounted() {
        this.chartData = this.setChartData();
        this.chartOptions = this.setChartOptions();
    },
    data() {
        return {
            months: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
            years: [2020, 2021, 2022, 2023, 2024, 2025],
            base_filter: 'yearly',
            selected_month: '',
            selected_year: '',
            chartData: null,
            chartOptions: null,
            modelToDisplay: 'animal_model',
            modelTitle: 'Animaux recuillis'
        };
    },

    computed: {
        filteredAnimals() { return this.filterByDate(this.animal_model); },
        filteredAdoptions() { return this.filterByDate(this.adoption_model); },
        filteredAvailables() { return this.filterByDate(this.available_model); },
        filteredCures() { return this.filterByDate(this.cure_model); },
        setLabels() {
            if (this.base_filter === 'monthly') {
                return ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'];
            } else {
                return [2020, 2021, 2022, 2023, 2024, 2025];
            }
        },
        datas() {
            return [
                {
                    model: this.filteredAdoptions.length,
                    color: 'text-main-red',
                    colorOpacity: 'bg-main-red-opacity',
                    title: 'Animaux adoptés',
                    gridPos: 'row-start-1 row-span-1',
                    svg: 'hearth',
                    modelName: 'adoption_model',
                },
                {
                    model: this.filteredAvailables.length,
                    color: 'text-main-yellow',
                    colorOpacity: 'bg-main-yellow-opacity',
                    title: 'Animaux disponibles',
                    gridPos: 'row-start-1 row-span-1',
                    svg: 'paw',
                    modelName: 'available_model',
                },
                {
                    model: this.filteredAnimals.length,
                    color: 'text-main-blue',
                    colorOpacity: 'bg-main-blue-opacity',
                    title: 'Animaux recueillis',
                    gridPos: 'row-start-1 row-span-1',
                    svg: 'hand',
                    modelName: 'animal_model',
                },
                {
                    model: this.filteredCures.length,
                    color: 'text-main-lightBlue',
                    colorOpacity: 'bg-main-lightBlue-opacity',
                    title: 'Animaux en soin',
                    gridPos: 'col-start-4 col-span-1 row-start-1 row-span-1',
                    svg: 'vaccine',
                    modelName: 'cure_model',

                }
            ];
        },
    },

    watch: {
        base_filter() {
            this.chartData = this.setChartData();
        },
        selected_year() {
            this.chartData = this.setChartData();
        },
        modelToDisplay() {
            this.chartData = this.setChartData();
        }
    },

    methods: {
        filterByDate(model) {
            return model.filter((data) => {
                const [year, month] = data.split('-').map(Number);

                if (this.selected_year && year !== this.selected_year) {
                    return false;
                }

                if (this.base_filter === 'monthly' && this.selected_month && month !== this.selected_month) {
                    return false;
                }

                return true;
            });
        },
        toCamelCase(string) {
            const tokens = string.split(/[_\s]+/).filter(Boolean);
            return tokens[0] + tokens.slice(1).map(word => word[0].toUpperCase() + word.slice(1)).join('');
        },
        setData(model) {
            if (this.base_filter === 'monthly') {
                const monthCounts = Array(12).fill(0);

                model.forEach((date) => {
                    const [year, month] = date.split('-').map(Number);

                    if (!this.selected_year || year === this.selected_year) {
                        monthCounts[month - 1]++;
                    }
                });

                return monthCounts;
            } else {
                const yearCounts = {};

                model.forEach((date) => {
                    const [year] = date.split('-').map(Number);
                    yearCounts[year] = (yearCounts[year] || 0) + 1;
                });

                return this.years.map(year => yearCounts[year] || 0);
            }
        },
        setChartData() {
            const documentStyle = getComputedStyle(document.documentElement);

            const modelData = this[this.modelToDisplay] || this.adoption_model;

            return {
                labels: this.setLabels,
                datasets: [
                    {
                        label: this.modelTitle,
                        data: this.setData(modelData),
                        fill: false,
                        borderColor: documentStyle.getPropertyValue('--main-yellow') || '#F6C449',
                        tension: 0.4
                    },
                ]
            };
        },
        setChartOptions() {
            const documentStyle = getComputedStyle(document.documentElement);
            const textColorSecondary = '#666';
            const surfaceBorder = '#ddd';

            return {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: textColorSecondary
                        },
                        grid: {
                            color: surfaceBorder
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: textColorSecondary,
                            stepSize: 1
                        },
                        grid: {
                            color: surfaceBorder
                        }
                    }
                }
            };
        },
        handleDisplayModel (model, title) {
            this.modelToDisplay = model;
            this.modelTitle = title;
        }
    }
};
</script>

<style scoped>

</style>
