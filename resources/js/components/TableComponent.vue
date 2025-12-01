<template>
    <table class="w-full rounded-xl overflow-hidden">
        <thead class="bg-softGray/50 text-left">
        <tr class="">
            <th v-for="col in cols" class="px-2 py-4 border border-softGray">
                {{ col }}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(row, rIndex) in rows" :key="rIndex" class="even:bg-white odd:bg-gray-50">
            <td v-for="field in fields" :key="field" class="border border-softGray p-2">
                <img v-if="field === 'image'" :src="row[field]" alt="Image"
                     class="w-14 h-14 object-cover rounded-full object-top mx-auto" />
                <span v-else>{{ row[field] }}</span>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: '',
    props: {
        cols: {
            type: Array,
            default:
                ['Image', 'Name', 'Espèce', 'Status']
        },
        fields: {
            type: Array,
            default: () => ['image', 'name', 'species', 'status']
        },
        rows: {
            type: Array,
            default:
                [
                    {
                        image: '../../../../assets/img/dog.png',
                        name: 'J-P. Rouve',
                        species: 'Chien',
                        status: 'En attente'
                    },
                    {
                        image: 'image',
                        name: 'J-P. Rouve',
                        species: 'Chien',
                        status: 'En attente'
                    },
                    {
                        image: 'image',
                        name: 'J-P. Rouve',
                        species: 'Chien',
                        status: 'En attente'
                    },
                    {
                        image: 'image',
                        name: 'J-P. Rouve',
                        species: 'Chien',
                        status: 'En attente'
                    }
                ]
        }

    },

    data() {
        return {};
    },

    methods: {}
};
</script>

<style>

</style>
