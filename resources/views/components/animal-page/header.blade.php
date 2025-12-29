@props(['name', 'images'])
@php
    $images = json_decode($images, true);
    $imagesPath = array_keys($images);
@endphp
<section aria-labelledby="animal-name" class="grid-basic">
    <img src="{{asset($imagesPath[0])}}" alt="{{ __('content.image_of', ['name' => $name]) }}"
         class="w-full rounded-btn aspect-video object-cover object-top col-start-2 col-end-7 md:col-start-3 md:col-end-11 flex flex-col items-center">
    <h2 class="big-title col-span-full mx-auto mt-11 lg:mt-sectionPadding mb-8">
        {{$name}}
    </h2>
    <x-animal-page.description-list/>
</section>
