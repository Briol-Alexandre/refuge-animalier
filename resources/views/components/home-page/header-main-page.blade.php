<section aria-labelledby="home-page-title" class="grid-basic relative">
    <x-svgs.bg-shape :blue="false" :class="'-top-92 -right-60 -z-10'"/>
    <x-svgs.bg-shape :blue="true" :class="'-z-20 top-16'"/>
    <div class="col-start-2 col-end-7">
        <x-header-image/>
        <h2 id="home-page-title" class="big-title pb-5">
            Un <strong>foyer</strong> pour chaque patte, un <strong>sourire</strong> pour chaque
            <strong>cœur</strong>
        </h2>
        <p class="text-mobile text-center mb-5">Chaque jour, notre équipe de bénévoles s’engage à offrir à chaque
            compagnon une seconde chance, beaucoup d’amour, et un foyer où il pourra s’épanouir.</p>
        <div class="flex flex-col gap-4">
            <x-button :route="''" :label="'Adoptez !'" :type="'light'"/>
            <x-button :route="''" :label="'En savoir plus'" :type="'dark'"/>
        </div>
    </div>
</section>
