<div class="slider-init relative transition-all duration-500 gap-6 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4">
    <x-slider.key-card :title="__('label.sheltered_animals')" :num="'23'" :opacity="'bg-main-red-opacity'" :color="'text-main-red'">
        <x-svgs.hearth :class="'w-10 h-10 mt-2'"/>
    </x-slider.key-card>
    <x-slider.key-card :title="__('label.adopted_animals')" :num="'1000'" :opacity="'bg-main-blue-opacity'" :color="'text-main-blue'">
        <x-svgs.hand :class="'w-10 h-10'"/>
    </x-slider.key-card>
    <x-slider.key-card :title="__('label.volunteer')" :num="'23'" :opacity="'bg-main-green-opacity'" :color="'text-main-green'">
        <x-svgs.person :class="'w-8 h-8'"/>
    </x-slider.key-card>
    <x-slider.key-card :title="__('label.available_animals')" :num="'23'" :opacity="'bg-main-yellow-opacity'" :color="'text-main-yellow'">
        <x-svgs.paw :class="'w-10 h-10'"/>
    </x-slider.key-card>
</div>
