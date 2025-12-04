<template>
    <p class="font-bold">{{title}}</p>
    <ul class="flex flex-col gap-4">
        <li v-for="notification in notifications" class="p-2 border border-softGray rounded-lg flex justify-between items-center">
            <NotificationCard :title="notification.title" :date="dateFormat(notification.created_at)" :notif="notification"/>
        </li>
    </ul>
</template>

<script>
import NotificationCard from '@/components/widget/dashboard-page/NotificationCard.vue';

export default {
  name: "",
    components: { NotificationCard },
  props: ['notifications', 'title'],

  data() {
    return {

    }
  },

  methods: {
      dateFormat(date) {
          date = new Date(date);
          return `${date.getDay()}/${date.getMonth()}/${date.getFullYear()}`
      }
  }
}
</script>

<style>

</style>
