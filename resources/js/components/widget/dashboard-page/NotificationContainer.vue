<template>
    <section
        class="col-start-2 col-end-8 row-start-3 row-span-5 rounded-2xl border border-softGray px-6 pt-6 flex flex-col gap-4 relative overflow-y-scroll mb-0"
        aria-labelledby="notification-section">
        <h2 id="notification-section" class="font-atten font-medium text-2xl flex gap-2 items-center">
            <Notifications />
            Vos notifications non lues
        </h2>
        <NotificationList :notifications="urgents" title="Vos urgences"/>
        <NotificationList :notifications="notifications" title="Vos notifications"/>
        <div class="sticky bottom-0 left-0 text-center w-full bg-white rounded-b-2xl py-2">
            <Link :href="index()"
                  class="hover:underline">
                Voir toutes les notifications
            </Link>
        </div>
    </section>
</template>

<script>
import Notifications from "@/components/svgs/Notifications.vue";
import NotificationList from "@/components/widget/dashboard-page/NotificationList.vue";
import {Link} from "@inertiajs/vue3";
import { index } from "@/actions/App/Http/Controllers/NotificationsController"

export default {
  name: "",
    components: {Link, NotificationList, Notifications},
  props: ['notifications', 'urgents'],

  data() {
    return {
        datas: [
        ]
    }
  },

  methods: {
    index
  }
}
</script>

<style>

</style>
