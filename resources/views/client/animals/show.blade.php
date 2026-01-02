@props(['animal'])
<x-layouts.client-layout>
    <x-animal-page.header :name="$animal->name" :images="$animal->images" :animal="$animal"/>
    <x-animal-page.description-section :name="$animal->name" :desc="$animal->desc" />
    <x-animal-page.photos :name="$animal->name" :images="[
        ['url' => asset('assets/img/dog.png'), 'alt' => __('content.image_of', ['name' => $animal->name])],
        ['url' => asset('assets/img/dog.png'), 'alt' => __('content.image_of', ['name' => $animal->name])],
        ['url' => asset('assets/img/dog.png'), 'alt' => __('content.image_of', ['name' => $animal->name])],
    ]" />
    <x-animal-page.form :title="__('animal_form.title')" :btn-label="__('contact.submit')" :animal-id="$animal->id" />
</x-layouts.client-layout>
