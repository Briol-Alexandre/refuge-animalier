<template>
    <div class="grid grid-cols-3 gap-2">
        <img :src="animal.image" :alt="`Photo de ${animal.name}`" class="w-full h-full object-cover rounded-full mt-2" />
        <div class="col-span-2">
            <div class="mb-2 flex gap-4 items-center">
                <h2 class="text-2xl font-atten font-black">{{ animal.name }}</h2>
                <span class="text-sm">{{animal.status}}</span>
            </div>
            <dl class="flex flex-col gap-2">
                <div class="flex gap-2">
                    <dt class="font-bold">Âge&nbsp;:</dt>
                    <dd>3 mois</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Sexe&nbsp;:</dt>
                    <dd>Mâle</dd>
                </div>
                <div class="flex gap-2">
                    <dt class="font-bold">Pelage&nbsp;:</dt>
                    <dd>Noir</dd>
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
            <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et
                ea rebum. Stet clita kasd gubergren, no sea takimata</p>
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
