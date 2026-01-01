<template>
    <li class="border border-softGray rounded-lg p-2 flex justify-between items-center">
        <a
            @click.prevent
            :href="route"
            class="hover:cursor-pointer truncate max-w-[120px]"
            :title="title"
        >
            {{ title }}
        </a>
        <Download/>
    </li>
</template>

<script>
import Download from '@/components/svgs/Download.vue';

export default {
    name: "",
    components: { Download },
    props: ['title', 'route'],
}
</script>
