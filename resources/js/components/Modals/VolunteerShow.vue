<template>
    <div class="grid grid-cols-3 gap-2">
        <img :src="volunteer.avatar" :alt="`Photo de ${volunteer.name}`" class="w-full h-full object-cover mt-2" />
        <div class="col-span-2">
            <div class="mb-2 flex gap-4 items-center">
                <h2 class="text-3xl font-atten font-black">{{ volunteer.name }}</h2>
            </div>
            <dl class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <dt class="font-bold">Email&nbsp;:</dt>
                    <dd>{{ volunteer.email }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Téléphone&nbsp;:</dt>
                    <dd>{{ volunteer.tel }}</dd>
                </div>
            </dl>
        </div>
        <div>
            <p class="font-atten text-2xl font-black mb-2 mt-4">Permissions</p>
            <ul class="flex gap-2">
                <li v-for="permission in volunteer.permissions"
                    class="text-sm bg-main-blue-opacity rounded-full px-1 py-px">{{ permission.name }}
                </li>
            </ul>
        </div>
        <div class="col-span-full">
            <p class="font-atten text-2xl font-black mb-2 mt-4">Disponibilités</p>
            <table class="w-full text-left">
                <tr>
                    <th></th>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                    <th>Samedi</th>
                    <th>Dimanche</th>
                </tr>
                <tr>
                    <th>Matin</th>
                    <td>Oui</td>
                    <td>Oui</td>
                    <td>Non</td>
                    <td>Non</td>
                    <td>Non</td>
                    <td>Oui</td>
                    <td>Oui</td>
                </tr>
                <tr>
                    <th>Après-Midi</th>
                    <td>Oui</td>
                    <td>Oui</td>
                    <td>Non</td>
                    <td>Non</td>
                    <td>Non</td>
                    <td>Oui</td>
                    <td>Oui</td>
                </tr>
                <tr>
                    <th>Soir</th>
                    <td>Oui</td>
                    <td>Oui</td>
                    <td>Non</td>
                    <td>Non</td>
                    <td>Non</td>
                    <td>Oui</td>
                    <td>Oui</td>
                </tr>
            </table>

        </div>
    </div>
</template>

<script>
export default {
    props: {
        volunteer: Object
    }
};
</script>
<style scoped>
th {
    background: rgba(73, 73, 73, 0.1);
}
table * {
    padding: 10px;
    border: 1px var(--color-softGray) solid;
}
</style>
