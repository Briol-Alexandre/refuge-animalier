<section aria-labelledby="home-page-title" class="relative">
    <x-svgs.bg-shape :blue="false" :class="'-top-92 -right-60 -z-10 '"/>
    <x-svgs.bg-shape :blue="true" :class="'-z-20 top-16'"/>
    <div class="grid-basic items-center">
        <div class="col-start-2 col-end-7 md:col-start-7 md:col-end-12">
            <x-header-image/>
        </div>
        <div class="col-start-2 col-end-7 md:row-start-1 lg:col-end-6">
            <h2 id="home-page-title" class="big-title">
                Un <strong>foyer</strong> pour chaque patte, un <strong>sourire</strong> pour chaque
                <strong>cœur</strong>
            </h2>
            <p class="text-content text-center md:text-left my-5">Chaque jour, notre équipe de bénévoles
                s’engage à offrir à
                chaque
                compagnon une seconde chance, beaucoup d’amour, et un foyer où il pourra s’épanouir.</p>
            <div class=" flex flex-col md:flex-row gap-4">
                <x-button :route="''" :label="'Adoptez !'" :type="'light'"/>
                <x-button :route="''" :label="'En savoir plus'" :type="'dark'"/>
            </div>
        </div>
    </div>
</section>
