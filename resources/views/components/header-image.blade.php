<div class="min-h-72 h-72 lg:min-h-90 xl:min-h-[500px] rounded-btn mb-normal relative">
    <img src="{{ asset('assets/img/home-img.png') }}"
         alt="Image d'un chien et d'un chat"
         class="w-full h-full object-cover rounded-btn">

    <x-bubble :color="'text-main-red'" :opacity="'bg-main-red-opacity'" :label="__('label.sheltered_animals')"
              :num="'53'" :class="'bubble1 group-bubble1'" :padding="true">
        <x-svgs.hearth :class="'w-5 h-5 xl:w-8 xl:h-8'"/>
    </x-bubble>
    <x-bubble :color="'text-main-yellow'" :opacity="'bg-main-yellow-opacity'" :label="__('label.available_animals')"
              :num="'53'" :class="'bubble2 group-bubble1'" :padding="false">
        <x-svgs.paw :class="'w-5 h-5 xl:w-8 xl:h-8'"/>
    </x-bubble>
    <x-bubble :color="'text-main-green'" :opacity="'bg-main-green-opacity'" :label="__('label.volunteer')"
              :num="'53'" :class="'bubble3 group-bubble2'" :padding="false">
        <x-svgs.person :class="'w-5 h-5 xl:w-8 xl:h-8'"/>
    </x-bubble>
    <x-bubble :color="'text-main-blue'" :opacity="'bg-main-blue-opacity'" :label="'Animaux adoptés'"
              :num="'53'" :class="'bubble4 group-bubble2'" :padding="false">
        <x-svgs.hand :class="'w-5 h-5 xl:w-8 xl:h-8'"/>
    </x-bubble>

</div>
