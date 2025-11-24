@props(['name', 'age', 'breed', 'desc', 'link' =>null])
<article aria-labelledby="{{ $name }}-card" class="slider-item-animal relative h-fit last:mb-0 sm:h-80">
    <div class="group relative h-full rounded-btn overflow-hidden">
        <a href="{{$link}}" class="absolute-position z-20"></a>
        <div class="max-sm:hidden absolute inset-0 rounded-btn bg-gradient-to-b from-transparent to-black/60
                    transition-all duration-300 group-hover:bg-black/40"></div>
        <img src="{{ asset('assets/img/dog.png') }}"
             alt="Image de {{ $name }}"
             class="w-full sm:h-full h-1/4 object-cover object-top">
        <div class="animal-card-info relative z-10 p-3 max-sm:bg-softGray/20 max-sm:pb-4">
            <h3 id="{{ $name }}-card" class="font-bold font-atten text-xl text-main-yellow">
                {{ $name }}
            </h3>
            <div class="animal-info h-fit text-xs  sm:text-white text-text font-normal
                        sm:max-h-0 overflow-hidden sm:opacity-0
                        transition-all duration-500 ease-out
                        group-hover:max-h-[500px] group-hover:opacity-100">
                <span class="grid grid-cols-2 gap-2 py-1 text-xxs
                             border-y  border-text sm:border-white/50 divide-x  divide-text sm:divide-white/50">

                    <span class="flex items-center gap-1">
                        <x-svgs.paw class="w-5 h-5"/>
                        <div>
                            <p class="font-bold">Race</p>
                            <p>{{$breed}}</p>
                        </div>
                    </span>

                    <span class="flex items-center gap-1">
                        <x-svgs.calendar class="w-5 h-5"/>
                        <div>
                            <p class="font-bold">Âge</p>
                            <p>{{$age}}</p>
                        </div>
                    </span>

                </span>
                <p class="my-2 line-clamp-5">
                    {{$desc}}
                </p>
                <div class="button-light-hvr-lgt z-20 mx-auto">Adoptez-moi !</div>
            </div>
        </div>

    </div>
</article>
