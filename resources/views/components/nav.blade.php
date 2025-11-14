<header class="w-full py-normal px-4 fixed">
    <span class="bg-white absolute top-0 left-0 w-full h-full -z-20">
    </span>
    <div class="flex justify-between items-center relative z-40">
        <div class="z-40">
            <x-logo/>
        </div>
        <input type="checkbox" id="burger" class="absolute invisible">
        <label for="burger" class="burger-container burger-close z-40">
            <span class="burger-line burger-line1"></span>
            <span class="burger-line burger-line2"></span>
            <span class="burger-line burger-line3"></span>
        </label>

        <nav
            class="text-center h-screen flex flex-col justify-center main-nav nav-close bg-softBlue fixed top-0 left-0 w-full z-30">
            <h2 class="sr-only">Navigation Principale</h2>
            <ul class="flex flex-col gap-huge my-auto">
                <x-nav-item :label="__('nav.homepage')" :route="route('home.client')" :class="'link'"/>
                <x-nav-item :label="__('nav.happypaws')" :route="route('paws.client')" :class="'link'"/>
                <x-nav-item :label="__('nav.animals')" :route="route('animals.client')" :class="'link'"/>
                <x-nav-item :label="__('nav.contact')" :route="route('animals.client')" :class="'button-dark'"/>
            </ul>
        </nav>

    </div>
</header>
