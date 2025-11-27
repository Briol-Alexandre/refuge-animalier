<template>
    <ul class="flex flex-col gap-4">
        <NotificationCard title="Texte de notification" />
        <NotificationCard title="Texte de notification" />
        <NotificationCard title="Texte de notification" />
        <NotificationCard title="Texte de notification" />
        <NotificationCard title="Texte de notification" />
        <NotificationCard title="Texte de notification" />
        <NotificationCard title="Texte de notification" />
        <NotificationCard title="Texte de notification" />
    </ul>
</template>

<script>
import NotificationCard from '@/components/widget/dashboard-page/NotificationCard.vue';

export default {
  name: "",
    components: { NotificationCard },
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
