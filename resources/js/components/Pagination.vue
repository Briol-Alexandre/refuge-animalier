<template>
    <div class="absolute bottom-2 right-4 flex gap-2 items-center">
        <div v-for="link in links" :key="link.label">
            <button
                v-if="link.url"
                @click="go(link.url)"
                class="px-2 py-1"
                :class="{ 'underline font-bold': link.active }"
                v-html="formatLabel(link.label)"
            />
            <span
                v-else
                class="px-2 py-1 text-gray-400"
                v-html="formatLabel(link.label)"
            ></span>

        </div>
    </div>
</template>

<script>
import { router } from '@inertiajs/vue3';

export default {
    props: {
        links: Array
    },

    methods: {
        go(url) {
            router.visit(url, {
                preserveScroll: true,
                preserveState: true
            });
        },

        formatLabel(label) {
            if (label.includes('Previous')) return '&lt;';
            if (label.includes('Next')) return '&gt;';
            return label;
        }
    }
}
</script>
