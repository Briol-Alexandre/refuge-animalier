<!doctype html>
<html lang="{!! app()->getLocale() !!}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])
    @vite(['resources/js/scripts/main.js'])
    <title>{{config('app.name')}}</title>
</head>

<body class="font-poppins overflow-x-hidden max-w-[1500px] mx-auto">
    <h1 class="sr-only">{{ config('app.name') }}</h1>
    <x-nav />
    <main class="mt-24 lg:mt-32 relative">
        <x-svgs.bg-shape :blue="false" :class="'-top-92 -right-60 -z-10 lg:-top-[500px] lg:scale-300 ' .
        (request()->routeIs('contact.client') ? 'fill-main-yellow-opacity' : '')" />
        <x-svgs.bg-shape :blue="true" :class="'-z-20 top-16 right-0 lg:-right-40 lg:top-52 lg:scale-x-600 lg:scale-y-150'" />
        {{$slot}}
    </main>
    <footer class="bg-text grid-basic place-items-center gap-10 py-10">
        <div class="col-span-full md:col-start-3 md:col-end-4 flex flex-col justify-between gap-4">
            <x-logo-white />
            <ul class="text-sm text-softGray flex flex-col gap-2">
                <li class="flex gap-2">
                    <x-svgs.location :class="'w-5'" />
                    Rue de la rue, n°12,3 Erps-Kwerps
                </li>
                <li class="flex gap-2">
                    <x-svgs.tel :class="'w-5'" />
                    <a href="tel:0444 44 44 44">0444 44 44 44</a>
                </li>
                <li class="flex gap-2">
                    <x-svgs.mail :class="'w-5'" />
                    <a href="mailto:lespattesheureuses@yahoo.com">lespattesheureuses@yahoo.com</a>
                </li>
            </ul>
        </div>
        <nav class="col-start-2 col-end-7 md:col-start-6 md:col-end-8 max-md:text-center text-softGray text-sm">
            <h2 class="font-extrabold mb-4">{{ __('footer.section_navigation') }}</h2>
            <ul class="flex flex-col gap-4">
                <x-nav-item :route="route('home.client')" :label="__('nav.homepage')" />
                <x-nav-item :route="route('paws.client')" :label="__('nav.happypaws')" />
                <x-nav-item :route="route('animals.client')" :label="__('nav.animals')" />
                <x-nav-item :route="route('contact.client')" :label="__('nav.contact')" />
            </ul>
        </nav>
        <div
            class="col-start-2 col-end-7 md:col-start-9 md:col-end-12 max-md:text-center text-softGray text-sm flex flex-col gap-6">

            <span class="">
                <p class="font-extrabold mb-4 text-softGray">{{ __('footer.section_socials') }}</p>
                <ul class="flex gap-4 max-md:justify-center">
                    <li>
                        <a href="https://www.instagram.com">
                            <x-svgs.socials.instagram />
                        </a>
                    </li>
                    <li>
                        <a href="https://www.facebook.com">
                            <x-svgs.socials.facebook />
                        </a>
                    </li>
                </ul>
            </span>
            <span class="">
                <p class="font-extrabold mb-4 text-softGray">{{ __('footer.section_hours') }}</p>
                <ul class="text-softGray flex gap-4 justify-center flex-col">
                    <li>{{ __('footer.hours_mon_thu') }}</li>
                    <li>{{ __('footer.hours_fri') }}</li>
                </ul>
            </span>
        </div>
    </footer>
</body>

</html>
