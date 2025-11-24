<x-layouts.client-layout>
    <section aria-labelledby="animal-name" class="grid-basic">
        <img src="{{asset('assets/img/dog.png')}}" alt="Photo de {Name}"
             class="w-full rounded-btn aspect-video object-cover object-top col-start-3 col-end-11 flex flex-col items-center">
        <h2 class="big-title col-span-full mx-auto mt-sectionPadding mb-8">
            J.P. Rouve
        </h2>
        <dl class="col-start-3 col-end-11 grid grid-cols-6 gap-12">
            <x-animal-page.description :label="'Âge'" :value="'3 mois'"/>
            <x-animal-page.description :label="'Sexe'" :value="'Mâle'"/>
            <x-animal-page.description :label="'Pelage'" :value="'Blond'"/>
            <x-animal-page.description :label="'Vaccins'" :value="'À jour'"/>
            <x-animal-page.description :label="'Espèce'" :value="'Chien'"/>
            <x-animal-page.description :label="'Race'" :value="'G. Retriever'"/>
        </dl>

    </section>
</x-layouts.client-layout>
