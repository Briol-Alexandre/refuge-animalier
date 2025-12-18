<template>
    <table class="hidden md:table w-full overflow-hidden">
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
                        {{ tableRow.name ?? 'Non renseigné' }}
                    </span>
                </span>

                <span v-else-if="typeof row[field] === 'object' && row[field] !== null">
                    {{ row[field]?.name ?? 'Non renseigné' }}
                </span>

                <span v-else>
                    {{ row[field] ?? 'Non renseigné' }}
                </span>
            </td>
        </tr>
        </tbody>
    </table>


    <div class="md:hidden flex flex-col gap-4">
        <div v-for="(row, index) in rows" :key="index"
             class="bg-white rounded-lg p-4 shadow-sm border border-softGray hover:shadow-md transition-shadow cursor-pointer"
             @click="$emit('row-click', row)">

            <div v-for="(field, fieldIndex) in fields" :key="field" class="mb-3 last:mb-0">
                <div class="text-xs text-gray-500 font-medium mb-1">
                    {{ cols[fieldIndex] }}
                </div>
                <div v-if="['images', 'avatar', 'image'].includes(field)" class="flex justify-center">
                    <img :src="getImageSrc(row[field])"
                         alt="Image"
                         class="w-20 h-20 object-cover rounded-full object-top" />
                </div>


                <div v-else-if="Array.isArray(row[field])" class="flex flex-wrap gap-1">
                    <span v-for="(tableRow, i) in row[field]" :key="i"
                          class="text-xs bg-main-blue-opacity rounded-full px-2 py-1">
                        {{ tableRow.name ?? 'Non renseigné' }}
                    </span>
                </div>

                <div v-else-if="typeof row[field] === 'object' && row[field] !== null" class="text-sm">
                    {{ row[field]?.name ?? 'Non renseigné' }}
                </div>


                <div v-else class="text-sm">
                    {{ row[field] ?? 'Non renseigné' }}
                </div>
            </div>
        </div>
    </div>
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
