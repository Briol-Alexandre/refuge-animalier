<x-layouts.client-layout>
    <x-paws-page.header-paws-page :title="__('headings.header-paws')" :content="__('content.content-header-paws')" :img_path="asset('assets/img/shelter.png')"/>
    <x-paws-page.list-container/>
    <x-paws-page.quote :quote="__('content.quote')" :author="__('content.quote-author')"/>
    <x-home-page.cta :title="__('headings.want-benevole')"/>
</x-layouts.client-layout>
