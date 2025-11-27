<script setup lang="ts">
import { home } from '@/routes';
import { Link } from '@inertiajs/vue3';
import Logo from '@/components/svgs/Logo.vue';

defineProps<{
    title?: string;
    description?: string;
}>();
</script>

<template>
    <div
        class="flex min-h-svh flex-col items-center justify-center gap-6 bg-gray-50 p-6 md:p-10"
    >
        <div class="w-1/2">
            <div class="flex flex-col gap-8 rounded-btn bg-white border border-gray-200 p-20">
                <div class="flex flex-col items-center gap-4">
                    <Link
                        :href="home()"
                        class="flex flex-col items-center gap-2 font-medium"
                    >
                            <Logo :classes="'w-150'"/>
                        <span class="sr-only">{{ title }}</span>
                    </Link>
                    <div class="space-y-2 text-center">
                        <h1 class="title !mb-0">{{ title }}</h1>
                    </div>
                </div>
                <slot />
            </div>
        </div>
    </div>
</template>
