<x-layouts.client-layout>
    <x-home-page.header-main-page/>
    <section aria-labelledby="key-number" class="grid-basic mt-11 mb-20">
        <h2 id="key-number" class="title col-start-2 col-end-7 text-center">
            Quelques chiffres clefs
        </h2>
        <div class="col-start-2 col-end-7 relative">
            <span
                data-action="next"
                class="slider-button hidden rotate-180 z-20 absolute top-1/2 -right-12 flex items-center -translate-y-1/3 justify-center w-10 h-10 rounded-full bg-main-yellow p-2">
                    <x-svgs.chevron/>
                </span>
            <span
                data-action="prev"
                class="slider-button hidden absolute z-20 top-1/2 flex items-center justify-center -left-12 -translate-y-1/3 w-10 h-10 rounded-full bg-main-yellow p-2">
                    <x-svgs.chevron/>
                </span>
            <ul class="slider-init relative transition-all">
                <li class="px-4 slider-item">
                    <article
                        class="key-card bg-white shadow-basic rounded-btn flex flex-col items-center justify-center py-2.5 mt-5">
                        <div class="bg-main-yellow-opacity w-14 h-14 flex items-center justify-center rounded-full">
                            <x-svgs.paw :class="'w-10 h-10'"/>
                        </div>
                        <div class="flex flex-col items-center mt-2">
                            <b class="bubble-number text-main-yellow">27</b>
                            <h3 class="text-xs">
                                Animaux adoptés
                            </h3>
                        </div>
                    </article>
                </li>
                <li class="px-4">
                    <article
                        class="key-card bg-white shadow-basic rounded-btn flex flex-col items-center justify-center py-2.5 mt-5">
                        <div class="bg-main-yellow-opacity w-14 h-14 flex items-center justify-center rounded-full">
                            <x-svgs.paw :class="'w-10 h-10'"/>
                        </div>
                        <div class="flex flex-col items-center mt-2">
                            <b class="bubble-number text-main-yellow">27</b>
                            <h3 class="text-xs">
                                Animaux adoptés
                            </h3>
                        </div>
                    </article>
                </li>
                <li class="px-4">
                    <article
                        class="key-card bg-white shadow-basic rounded-btn flex flex-col items-center justify-center py-2.5 mt-5">
                        <div class="bg-main-yellow-opacity w-14 h-14 flex items-center justify-center rounded-full">
                            <x-svgs.paw :class="'w-10 h-10'"/>
                        </div>
                        <div class="flex flex-col items-center mt-2">
                            <b class="bubble-number text-main-yellow">27</b>
                            <h3 class="text-xs">
                                Animaux adoptés
                            </h3>
                        </div>
                    </article>
                </li>
                <li class="px-4">
                    <article
                        class="key-card bg-white shadow-basic rounded-btn flex flex-col items-center justify-center py-2.5 mt-5">
                        <div class="bg-main-yellow-opacity w-14 h-14 flex items-center justify-center rounded-full">
                            <x-svgs.paw :class="'w-10 h-10'"/>
                        </div>
                        <div class="flex flex-col items-center mt-2">
                            <b class="bubble-number text-main-yellow">27</b>
                            <h3 class="text-xs">
                                Animaux adoptés
                            </h3>
                        </div>
                    </article>
                </li>
            </ul>
        </div>
    </section>
</x-layouts.client-layout>
