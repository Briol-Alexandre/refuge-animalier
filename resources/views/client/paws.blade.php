<x-layouts.client-layout>
    <x-paws-page.header-paws-page/>
    <x-paws-page.list-container/>
    <section aria-labelledby="quote" class="grid-basic">
        <h2 class="sr-only">Citation</h2>
        <p class="col-start-2 col-end-7 md:col-start-2 md:col-end-12 quote">
            <q>
                <span class="before">
                    "
                </span>
                J’ai fondé Les Pattes Heureuses avec la conviction que chaque animal mérite une chance. Voir un chien ou
                un chat retrouver confiance et amour est notre plus belle récompense.
                <span class="after">
                    "
                </span>
            </q>
            <cite>
                — Élise, fondatrice du refuge
            </cite>
        </p>
    </section>
    <x-home-page.cta :title="__('headings.want-benevole')"/>
</x-layouts.client-layout>
