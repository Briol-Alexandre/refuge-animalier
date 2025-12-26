import { usePage } from '@inertiajs/vue3';

export function useExportsStore(){
    const page = usePage();

    const exportList = page.props.exports as {name: string, url:string}  [];

    return {
        exportList
    };
}
