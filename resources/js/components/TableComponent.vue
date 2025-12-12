<template>
    <table class="w-full overflow-hidden">
        <thead class="bg-softGray/50 text-left">
        <tr class="rounded-xl">
            <th v-for="col in cols" :key="col" class="px-2 py-4 border border-softGray">
                {{ col }}
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(row, index) in rows" :key="index"
            class="even:bg-white odd:bg-gray-50 hover:cursor-pointer"
            @click="$emit('row-click', row)">
            <td v-for="field in fields" :key="field" class="border border-softGray p-2">
                <span v-if="['images', 'avatar', 'image'].includes(field)">
                        <img :src="getImageSrc(row[field])"
                             alt="Image"
                             class="w-14 h-14 object-cover rounded-full object-top mx-auto" />
                    </span>

                <span v-else-if="Array.isArray(row[field])">
                        <span v-for="(tableRow, i) in row[field]" :key="i"
                              class="text-xs bg-main-blue-opacity rounded-full px-1 py-px ml-1">
                            {{ tableRow.name ?? 'Inconnu' }}
                        </span>
                    </span>

                <span v-else-if="typeof row[field] === 'object' && row[field] !== null">
                        {{ row[field]?.name ?? 'Inconnu' }}
                    </span>

                <span v-else>
                        {{ row[field] ?? 'inconnu' }}
                    </span>
            </td>
        </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    name: 'TableComponent',
    props: {
        cols: {
            type: Array,
            default: () => ['Image', 'Name', 'Espèce', 'Status']
        },
        fields: {
            type: Array,
            default: () => ['image', 'name', 'species', 'status']
        },
        rows: {
            type: Array,
            default: () => [
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
                }
            ]
        }
    },

    methods: {
        getImageSrc(imageData) {
            if (typeof imageData === 'string') {
                if (imageData.startsWith('{') || imageData.startsWith('[')) {
                    try {
                        const parsed = JSON.parse(imageData);
                        if (typeof parsed === 'object' && !Array.isArray(parsed)) {
                            return Object.keys(parsed)[0] || '';
                        }
                        return parsed;
                    } catch (e) {
                        console.warn('Impossible de parser l\'image JSON:', e);
                        return imageData;
                    }
                }
                return imageData;
            }

            if (typeof imageData === 'object' && imageData !== null) {
                return Object.keys(imageData)[0] || '';
            }

            return '';
        }
    }
};
</script>
