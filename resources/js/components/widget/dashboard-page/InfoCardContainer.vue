<template>
    <InfoCard  opacity-color="bg-main-red-opacity" number="40" title="Adoptions" aria="adoption" color="text-main-red" grid-position="col-start-2 col-end-4 row-start-2 row-span-1">
        <Hearth color="#FF6E6E" />
    </InfoCard>
    <InfoCard  opacity-color="bg-main-yellow-opacity" number="40" title="Animaux disponibles" aria="animals" color="text-main-yellow" grid-position="col-start-4 col-end-6 row-start-2 row-span-1">
        <Paw color="#F6C449" classes="w-6"/>
    </InfoCard>
    <InfoCard  opacity-color="bg-main-blue-opacity" number="40" title="Animaux recueillis" aria="sheltered" color="text-main-blue" grid-position="col-start-6 col-end-8 row-start-2 row-span-1">
        <Hand color="#9747FF" classes="w-6" />
    </InfoCard>
    <InfoCard  opacity-color="bg-main-green-opacity" number="40" title="Bénévoles" aria="helpers" color="text-main-green" grid-position="col-start-8 col-end-10 row-start-2 row-span-1">
        <User color="#47FF56" />
    </InfoCard>
    <InfoCard  opacity-color="bg-main-lightBlue-opacity" number="40" title="Adoptions" aria="vaccine" color="text-main-lightBlue" grid-position="col-start-8 col-end-10 row-start-3 row-span-1">
        <Vaccine color="#00D4FF" />
    </InfoCard>
</template>

<script>
import Paw from "@/components/svgs/Paw.vue";
import InfoCard from "@/components/widget/dashboard-page/InfoCard.vue";
import Hearth from "@/components/svgs/Hearth.vue";
import Vaccine from "@/components/svgs/Vaccine.vue"
import Hand from "@/components/svgs/Hand.vue"
import User from "@/components/svgs/User.vue"

export default {
  name: "",
    components: {Hearth, InfoCard, Paw, Vaccine, Hand, User},
  props: [],

  data() {
    return {

    }
  },

  methods: {

  }
}
</script>

<style>

</style>
