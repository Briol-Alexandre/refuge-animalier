<template>
    <InfoCard v-for="data in datas" :opacity-color="data.colorOpacity" :number="data.model ?? 0"
              :title="data.title" :aria="toCamelCase(data.title)" :color="data.color" :grid-position="data.gridPos">
        <Hearth v-if="data.svg === 'hearth'" color="#FF6E6E" />
        <Paw v-if="data.svg === 'paw'" color="#F6C449" classes="w-6" />
        <Hand v-if="data.svg === 'hand'" color="#9747FF" classes="w-6" />
        <User v-if="data.svg === 'user'" color="#47FF56" />
        <Vaccine v-if="data.svg === 'vaccine'" color="#00D4FF" />
    </InfoCard>
</template>

<script>
import Paw from '@/components/svgs/Paw.vue';
import InfoCard from '@/components/widget/dashboard-page/InfoCard.vue';
import Hearth from '@/components/svgs/Hearth.vue';
import Vaccine from '@/components/svgs/Vaccine.vue';
import Hand from '@/components/svgs/Hand.vue';
import User from '@/components/svgs/User.vue';

export default {
    name: '',
    components: { Hearth, InfoCard, Paw, Vaccine, Hand, User },
    props: ['datas'],

    data() {
        return {};
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

<style>

</style>
