@props(['animal'])
<dl
    class="col-start-2 col-end-7 md:col-start-2 md:col-end-12 xl:col-start-3 xl:col-end-11 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-y-4 gap-x-12">
    <x-animal-page.description :label="__('label.age')" :value="$animal->age" />
    <x-animal-page.description :label="__('label.sex')" :value="$animal->sexe" />
    <x-animal-page.description :label="__('label.coat')" :value="$animal->coat" />
    <x-animal-page.description :label="__('label.vaccines')" :value="$animal->vaccines" />
    <x-animal-page.description :label="__('label.species')" :value="$animal->specie->name" />
    <x-animal-page.description :label="__('label.breed')" :value="$animal->breed->name" />
</dl>
