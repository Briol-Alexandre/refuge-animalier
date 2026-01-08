<x-layouts.client-layout>
    <x-home-page.header-main-page :volunteer="$volunteer_count" :available="$available_count" :animals="$animals_count" :adoptions="$adoption_count"/>
    <x-home-page.slider-main-page :volunteer="$volunteer_count" :available="$available_count" :animals="$animals_count" :adoptions="$adoption_count"/>
    <x-home-page.animal-slider-main-page :animals="$animals"/>
    <x-home-page.cta :title="__('headings.want-benevole')" />
</x-layouts.client-layout>
