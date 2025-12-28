<section aria-labelledby="adoptable-animals" class="mt-11 grid-basic">
    <h2 class="title text-center col-span-full" id="adoptable-animals">
        {!! __('headings.adoptable_animals') !!}
    </h2>
    <div class="container col-start-2 col-end-7 md:col-end-12 flex justify-between gap-x-4 relative">
        <button
            class="flex items-center bg-white border-2 border-main-yellow rounded-lg self-end h-fit py-1 px-2 btn-open gap-2 hover:cursor-pointer">
            <x-svgs.filters />
            {{ __('filters.title') }}
        </button>
        <div class="filters-container relative">
            <form method="dialog">
                <button type="submit"
                    class="close-form flex gap-2 items-center absolute top-4 right-4 md:top-[6.5px] md:left-[10px] hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        viewBox="0 0 16 16" role="img">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                    </svg>
                    <span class="hidden md:block">{{ __('filters.title') }}</span>
                </button>
            </form>
            <form action="" class="filters-content">
                <x-form.select :label="__('filters.species')" :id-name="'species'" :options="[
        ['value' => '', 'name' => __('filters.all')],
        ['value' => 'cat', 'name' => __('filters.cat')],
        ['value' => 'dog', 'name' => __('filters.dog')]
    ]" />
                <x-form.select :label="__('filters.breed')" :id-name="'breed'" :options="[
        ['value' => '', 'name' => __('filters.all')],
        ['value' => 'chihuahua', 'name' => 'Chihuahua'],
        ['value' => 'golden-retriever', 'name' => 'G. Retriever']
    ]" />
                <x-form.select :label="__('filters.coat')" :id-name="'coat'" :options="[
        ['value' => '', 'name' => __('filters.all')],
        ['value' => 'black', 'name' => __('filters.black')],
        ['value' => 'white', 'name' => __('filters.white')]
    ]" />
                <x-form.select :label="__('filters.age')" :id-name="'age'" :options="[
        ['value' => '', 'name' => __('filters.all')],
        ['value' => '1', 'name' => __('filters.lt_one_year')],
        ['value' => '2', 'name' => __('filters.lt_three_years')]
    ]" />
                <x-form.select :label="__('filters.sex')" :id-name="'sexe'" :options="[
        ['value' => '', 'name' => __('filters.all')],
        ['value' => 'male', 'name' => __('filters.male')],
        ['value' => 'female', 'name' => __('filters.female')]
    ]" />
                <div class="flex flex-col">
                    <label for="search">{{ __('filters.search') }}</label>
                    <input type="search" id="search" name="search" placeholder="{{ __('filters.search_placeholder') }}"
                        class="py-1 px-2 bg-white border-2 border-main-yellow rounded-lg">
                </div>

                <div class="col-span-full flex justify-between flex-1">
                    <button class="underline">
                        {{ __('filters.reset') }}
                    </button>
                    <button type="submit" class="button-light z-10 mx-0">
                        {{ __('filters.apply') }}
                    </button>
                </div>
            </form>
        </div>

        <form action="" class="flex flex-col js-search max-md:w-40">
            <label for="search" class="sr-only">{{ __('filters.search') }}</label>
            <input type="search" id="search" name="search" placeholder="{{ __('filters.search_placeholder') }}"
                class="py-1 px-2 bg-white border-2 border-main-yellow rounded-lg">
        </form>
    </div>
    <ul class="col-start-2 col-end-7 md:col-end-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @for ($i = 1; $i <= 20; $i++)
            <li class="col-span-1">
                <x-slider.animal-card :name="'J.P. Rouve'" :breed="'G. Retriever'" :age="'3 mois'" :desc="'Lorem Ipsum posjdqihufgjhbilwqg pqisgdo dfuyh gpiqvsf gh q ghvfuidg piqsufhgliudfghduhgpq qt p'"
                    :link="route('animals.client.show', 1)" />
            </li>
        @endfor
    </ul>
</section>