<header class="w-full py-normal max-md:px-4 fixed grid-basic">
    <span class="bg-white absolute top-0 left-0 w-full h-full -z-20">
    </span>
    <div class="flex justify-between items-center relative z-40 col-span-full md:col-start-2 md:col-end-12">
        <div class="z-40">
            <x-logo/>
        </div>
        <input type="checkbox" id="burger" class="absolute invisible">
        <label for="burger" class="burger-container burger-close z-40 lg:!hidden">
            <span class="burger-line burger-line1"></span>
            <span class="burger-line burger-line2"></span>
            <span class="burger-line burger-line3"></span>
        </label>

        <nav aria-labelledby="main-navigation"
            class="text-center max-lg:h-screen flex flex-col main-nav nav-close max-lg:bg-softBlue max-lg:fixed max-lg:top-0 max-lg:left-0 w-full z-30">
            <h2 class="sr-only" id="main-navigation">Navigation Principale</h2>
            <ul class="flex max-lg:flex-col max-lg:gap-huge justify-end gap-8 lg:items-center my-auto lg:text-sm xl:text-base">
                <x-nav-item :label="__('nav.homepage')" :route="route('home.client')" :class="request()->routeIs('home.client') ? 'active' : 'link'"/>
                <x-nav-item :label="__('nav.happypaws')" :route="route('paws.client')" :class="request()->routeIs('paws.client') ? 'active' : 'link'"/>
                <x-nav-item :label="__('nav.animals')" :route="route('animals.client')" :class="request()->routeIs('animals.client')||request()->routeIs('animals.client.show') ? 'active' : 'link'"/>
                <x-nav-item :label="__('nav.contact')" :route="route('animals.client')" :class="''" :aClass="'button-dark'"/>
            </ul>
        </nav>

    </div>
</header>
