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
        <main class="mt-24">
            {{$slot}}
        </main>
        <footer class="bg-text grid-basic place-items-center gap-10 py-10">
            <div class="col-span-full">
                <x-logo-white/>
            </div>
            <nav class="col-start-2 col-end-7 text-center text-softGray text-sm">
                <h2 class="sr-only">
                    Navigation pied de page
                </h2>
                <ul class="flex flex-col gap-4">
                    <x-nav-item :route="route('home.client')" :label="'Accueil'"/>
                    <x-nav-item :route="route('paws.client')" :label="'Les pattes heureuses'"/>
                    <x-nav-item :route="route('animals.client')" :label="'Nos animaux à l‘adoption'"/>
                    <x-nav-item :route="route('paws.client')" :label="'Nous contacter'"/>
                </ul>
            </nav>
            <ul class="col-start-3 col-end-6 flex gap-4">
                <li>
                    <a href="https://www.instagram.com"><x-svgs.socials.instagram/></a>
                </li>
                <li>
                    <a href="https://www.facebook.com"><x-svgs.socials.facebook/></a>
                </li>
            </ul>
        </footer>
    </body>
</html>
