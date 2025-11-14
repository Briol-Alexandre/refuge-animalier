<div class="min-h-72 h-72 rounded-btn mb-normal relative">
    <img src="{{ asset('assets/img/home-img.png') }}"
         alt="Image d'un chien et d'un chat"
         class="w-full h-full object-cover rounded-btn">

    <x-bubble :color="'text-main-red'" :opacity="'bg-main-red-opacity'" :label="'Animaux adoptés'"
              :num="'53'" :class="'bubble1 group-bubble1'" :padding="true">
        <x-svgs.hearth/>
    </x-bubble>
    <x-bubble :color="'text-main-yellow'" :opacity="'bg-main-yellow-opacity'" :label="'Animaux adoptés'"
              :num="'53'" :class="'bubble2 group-bubble1'" :padding="false">
        <x-svgs.paw :class="'w-5 h-5'"/>
    </x-bubble>
    <x-bubble :color="'text-main-yellow'" :opacity="'bg-main-yellow-opacity'" :label="'Animaux adoptés'"
              :num="'53'" :class="'bubble3 group-bubble2'" :padding="false">
        <x-svgs.paw :class="'w-5 h-5'"/>
    </x-bubble>
    <x-bubble :color="'text-main-yellow'" :opacity="'bg-main-yellow-opacity'" :label="'Animaux adoptés'"
              :num="'53'" :class="'bubble4 group-bubble2'" :padding="false">
        <x-svgs.paw :class="'w-5 h-5'"/>
    </x-bubble>

</div>
