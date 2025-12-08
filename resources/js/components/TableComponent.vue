<template>
    <table class="w-full overflow-hidden">
        <thead class="bg-softGray/50  text-left">
        <tr class="rounded-xl">
            <th v-for="col in cols" class="px-2 py-4  border border-softGray">
                {{ col }}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(row, index) in rows" :key="index" class="even:bg-white odd:bg-gray-50 hover:cursor-pointer"
            @click="$emit('row-click', row)">
            <td v-for="field in fields" :key="field" class="border border-softGray p-2">
                <img v-if="['image','avatar'].includes(field)" :src="row[field]" alt="Image"
                     class="w-14 h-14 object-cover rounded-full object-top mx-auto" />
                <span
                    v-else-if="Array.isArray(row[field])" v-for="tableRow in row[field]"
                    class="text-xs bg-main-blue-opacity rounded-full px-1 py-px ml-1">
                    {{ tableRow.name }}
                </span>

                <span v-else-if="typeof row[field] === 'object'">
                    {{row[field].name}}
                </span>

                <span v-else>
                    {{ row[field] }}
                </span>
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
