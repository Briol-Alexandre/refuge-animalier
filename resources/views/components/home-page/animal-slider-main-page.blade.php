<section aria-labelledby="animals-section" class="grid-basic mt-11">
    <h2 id="animals-section" class="title col-start-2 col-end-7 md:col-end-12 text-center">
        {!! __('headings.adopt_title') !!}
    </h2>
    <div class="relative col-start-2 col-end-7 md:col-end-12">
        <x-slider.slider-arrow-next :section_name="'animal'"/>
        <x-slider.slider-arrow-prev :section_name="'animal'"/>
        <x-slider.animal-slider-container :animals="$animals"/>
    </div>
    <a href="{{route("animals.client")}}" class="button-light col-span-full mx-auto mt-8">
        {!! __('label.all_animals') !!}
    </a>
</section>
