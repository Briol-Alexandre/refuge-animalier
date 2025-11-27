<template>
    <section
        class="col-start-2 col-end-8 row-start-3 row-span-full rounded-2xl border border-softGray p-6 flex flex-col gap-4 relative overflow-hidden"
        aria-labelledby="notification-section">
        <h2 id="notification-section" class="font-atten font-medium text-2xl flex gap-2 items-center">
            <Notifications />
            Vos notifications
        </h2>
        <NotificationList/>
        <div class="absolute bottom-0 left-0 text-center w-full bg-white rounded-b-2xl py-2 ">
            <Link href="/notifications"
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

export default {
  name: "",
    components: {Link, NotificationList, Notifications},
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
