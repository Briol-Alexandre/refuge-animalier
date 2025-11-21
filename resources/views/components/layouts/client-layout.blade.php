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
    <body class="font-poppins overflow-x-hidden">
        <div class="fixed top-2 left-2 z-50 px-2 py-1 text-white text-sm font-bold rounded bg-black/70">
            <span class="block sm:hidden">XS ( < 640px )</span>
            <span class="hidden sm:block md:hidden">SM ( ≥ 640px )</span>
            <span class="hidden md:block lg:hidden">MD ( ≥ 768px )</span>
            <span class="hidden lg:block xl:hidden">LG ( ≥ 1024px )</span>
            <span class="hidden xl:block 2xl:hidden">XL ( ≥ 1280px )</span>
            <span class="hidden 2xl:block">2XL ( ≥ 1536px )</span>
        </div>

        <h1 class="sr-only">Les pattes heureuses</h1>
        <x-nav/>
        <main class="mt-24 lg:mt-32 relative">
            <x-svgs.bg-shape :blue="false" :class="'-top-92 -right-60 -z-10 lg:-top-[500px] lg:scale-300'"/>
            <x-svgs.bg-shape :blue="true" :class="'-z-20 top-16 right-0 lg:-right-40 lg:top-52 lg:scale-x-600 lg:scale-y-150'"/>
            {{$slot}}
        </main>
        <footer class="bg-text grid-basic place-items-center gap-10 py-10">
            <div class="col-span-full md:col-start-3 md:col-end-4 flex flex-col justify-between gap-4">
                <x-logo-white/>
                <ul class="text-sm text-softGray flex flex-col gap-2">
                    <li class="flex gap-2">
                        <x-svgs.location :class="'w-5'"/>
                        Rue de la rue, n°12,3 Erps-Kwerps
                    </li>
                    <li class="flex gap-2">
                        <x-svgs.tel :class="'w-5'"/>
                        <a href="tel:0444 44 44 44">0444 44 44 44</a>
                    </li>
                    <li class="flex gap-2">
                        <x-svgs.mail :class="'w-5'"/>
                        <a href="mailto:lespattesheureuses@yahoo.com">lespattesheureuses@yahoo.com</a>
                    </li>
                </ul>
            </div>
            <nav class="col-start-2 col-end-7 md:col-start-6 md:col-end-8 max-md:text-center text-softGray text-sm">
                <h2 class="font-extrabold mb-4">
                    Navigation
                </h2>
                <ul class="flex flex-col gap-4">
                    <x-nav-item :route="route('home.client')" :label="'Accueil'"/>
                    <x-nav-item :route="route('paws.client')" :label="'Les pattes heureuses'"/>
                    <x-nav-item :route="route('animals.client')" :label="'Nos animaux à l‘adoption'"/>
                    <x-nav-item :route="route('paws.client')" :label="'Nous contacter'"/>
                </ul>
            </nav>
            <div
                class="col-start-2 col-end-7 md:col-start-9 md:col-end-12 max-md:text-center text-softGray text-sm flex flex-col gap-6">

            <span class="">
                    <p class="font-extrabold mb-4 text-softGray">Nos réseaux</p>
                    <ul class="flex gap-4 max-md:justify-center">
                        <li>
                            <a href="https://www.instagram.com">
                                <x-svgs.socials.instagram/>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com">
                                <x-svgs.socials.facebook/>
                            </a>
                        </li>
                    </ul>
                </span>
                <span class="">
                    <p class="font-extrabold mb-4 text-softGray">Nos horaires</p>
                    <ul class="text-softGray flex gap-4 justify-center flex-col">
                       <li>
                           Du lundi au jeudi : 8h30 - 17h
                       </li>
                        <li>
                            Vendredi : 8h30 - 15h
                        </li>
                    </ul>
                </span>
            </div>
        </footer>
    </body>
</html>
