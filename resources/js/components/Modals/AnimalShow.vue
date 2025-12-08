<template>
    <div class="grid grid-cols-3 gap-2">
        <img :src="animal.image" :alt="`Photo de ${animal.name}`" class="w-full h-full object-cover mt-2" />
        <div class="col-span-2">
            <div class="mb-2 flex gap-4 items-center">
                <h2 class="text-2xl font-atten font-black">{{ animal.name }}</h2>
                <span class="text-sm">{{ animal.status }}</span>
            </div>
            <dl class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <dt class="font-bold">Âge&nbsp;:</dt>
                    <dd>3 mois</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Espèce&nbsp;:</dt>
                    <dd>{{animal.specie.name}}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Race&nbsp;:</dt>
                    <dd>{{animal.breed.name}}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Sexe&nbsp;:</dt>
                    <dd>{{ animal.sexe }}</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Pelage&nbsp;:</dt>
                    <dd class="flex flex-col">
                        <ul class="list-disc list-inside">
                            <li v-for="coat in animal.coat">
                                {{ coat.name }}
                            </li>
                        </ul>
                    </dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Vaccins&nbsp;:</dt>
                    <dd>À jour</dd>
                </div>
            </dl>
            <div class="mt-2">
                <p class="font-bold">Notes</p>
                <ul class="list-disc list-inside">
                    <li><a href="">Note</a></li>
                    <li><a href="">Note</a></li>
                    <li><a href="">Note</a></li>
                    <li><a href="">Note</a></li>
                </ul>
            </div>
        </div>
        <div class="col-span-full">
            <p class="font-bold">Description</p>
            <p>
                {{animal.desc}}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        animal: Object
    }
};
</script>
