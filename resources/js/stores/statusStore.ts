import { usePage } from '@inertiajs/vue3';

export function useStatusStore() {
    const page = usePage();

    const statusList = page.props.statusList as { name: string; value: string }[];

    return {
        statusList
    };
}
