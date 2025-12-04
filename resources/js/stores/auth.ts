import { router } from '@inertiajs/vue3';
import { Method } from '@inertiajs/core';

export const useAuthStore = () => {
    const form = () => ({
        method: 'post' as Method | 'post',
        url: '/login',
        fields: {
            email: '',
            password: '',
            remember: false,
        },
        submit: function () {
            router.post(this.url, this.fields);
        },
    });

    return {
        form,
    };
};

export const store = useAuthStore();
