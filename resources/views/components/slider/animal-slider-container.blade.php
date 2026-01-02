@props(['animals'])
<div class="slider-init-animal transition-all duration-500 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
    @foreach($animals as $animal)

    <x-slider.animal-card :name="$animal?->name" :breed="$animal?->breed?->name" :age="$animal?->age" :desc="$animal?->desc" :images="$animal?->images"
                          :link="route('animals.client.show', $animal?->id)" />
    @endforeach
</div>
