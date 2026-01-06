@props(['animals', 'species', 'breeds', 'coats'])
<section aria-labelledby="adoptable-animals" class="mt-11 grid-basic">
    <h2 class="title text-center col-span-full" id="adoptable-animals">
        {!! __('headings.adoptable_animals') !!}
    </h2>
    <div class="container col-start-2 col-end-7 md:col-end-12 flex justify-between gap-x-4 relative">
        <button
            class="flex items-center bg-white border-2 border-main-yellow rounded-lg self-end h-fit py-1 px-2 btn-open gap-2 hover:cursor-pointer">
            <x-svgs.filters/>
            {{ __('filters.title') }}
        </button>
        <div class="filters-container relative">
            <form method="dialog">
                <button type="submit"
                        class="close-form flex gap-2 items-center absolute top-4 right-4 md:top-[6.5px] md:left-[10px] hover:cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                         viewBox="0 0 16 16" role="img">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                    <span class="hidden md:block">{{ __('filters.title') }}</span>
                </button>
            </form>
            <form action="{{route('animals.client')}}" method="get" class="filters-content">
                <x-form.select :label="__('filters.species')" :id-name="'specie'">
                    <option value="">{{__('filters.all')}}</option>
                    @foreach($species as $specie)
                        <option
                            value="{{$specie->id}}" {{old('specie', request('specie')) == $specie->id ? 'selected' : ''}}>{{$specie->name}}</option>
                    @endforeach
                </x-form.select>
                <x-form.select :label="__('filters.breed')" :id-name="'breed'">
                    <option value="">{{__('filters.all')}}</option>
                    @foreach($breeds as $breed)
                        <option
                            value="{{$breed->id}}" {{old('breed', request('breed')) == $breed->id ? 'selected' : ''}}>{{$breed->name}}</option>
                    @endforeach
                </x-form.select>
                <x-form.select :label="__('filters.coat')" :id-name="'coat'">
                    <option value="">{{__('filters.all')}}</option>
                    @foreach($coats as $coat)
                        <option
                            value="{{$coat->id}}" {{old('coat', request('coat')) == $coat->id ? 'selected' : ''}}>{{$coat->name}}</option>
                    @endforeach
                </x-form.select>
                <x-form.select :label="__('filters.age')" :id-name="'age'">
                    <option value="">{{__('filters.all')}}</option>
                    <option value="3">Jeune</option>
                    <option value="7">Adulte</option>
                    <option value="senior">Senior</option>
                </x-form.select>
                <x-form.select :label="__('filters.sex')" :id-name="'sexe'">
                    <option value="">{{__('filters.all')}}</option>
                    <option {{old('sexe', request('sexe')) ? 'selected' : ''}} value="male">Male</option>
                    <option {{old('sexe', request('sexe')) ? 'selected' : ''}} value="female">Female</option>
                </x-form.select>
                <div class="flex flex-col">
                    <label for="search">{{ __('filters.search') }}</label>
                    <input type="search" id="search" name="search" value="{{old('search', request('search'))??''}}"
                           placeholder="{{ __('filters.search_placeholder') }}"
                           class="py-1 px-2 bg-white border-2 border-main-yellow rounded-lg">
                </div>

                <div class="col-span-full flex justify-between flex-1">
                    <a class="underline" href="{{route('animals.client')}}">Réinitialiser</a>
                    <button type="submit" class="button-light z-10 mx-0">
                        {{ __('filters.apply') }}
                    </button>
                </div>
            </form>
        </div>

        <form action="{{route('animals.client')}}" method="get" class="flex flex-col js-search max-md:w-40">
            <label for="search" class="sr-only">{{ __('filters.search') }}</label>
            <input type="search" id="search" name="search" value="{{old('search', request('search'))??''}}"
                   placeholder="{{ __('filters.search_placeholder') }}"
                   class="py-1 px-2 bg-white border-2 border-main-yellow rounded-lg">
        </form>
    </div>
    <ul class="col-start-2 col-end-7 md:col-end-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @if($animals->count() > 0)
            @foreach($animals as $animal)
                <li class="col-span-1">
                    <x-slider.animal-card :name="$animal->name" :breed="$animal->breed->name" :age="$animal->age"
                                          :desc="$animal->desc" :images="$animal->images"
                                          :link="route('animals.client.show', $animal->id)"/>
                </li>
            @endforeach
        @else
            <p class="w-full text-center col-span-full mt-5 text-gray-600">Pas de résultats suite à vos demandes</p>
        @endif

    </ul>
</section>
