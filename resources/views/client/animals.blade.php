<x-layouts.client-layout>
    <x-paws-page.header-paws-page :title="__('headings.header-animals')" :content="__('content.content-header-animals')"
                                  :img_path="asset('assets/img/home-img.png')"/>
    <x-animal-page.grid/>
</x-layouts.client-layout>
