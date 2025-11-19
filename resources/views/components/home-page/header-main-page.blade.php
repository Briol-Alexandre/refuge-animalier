<section aria-labelledby="home-page-title" class="relative">
    <x-svgs.bg-shape :blue="false" :class="'-top-92 -right-60 -z-10 lg:-top-[500px] lg:scale-300'"/>
    <x-svgs.bg-shape :blue="true" :class="'-z-20 top-16 right-0 lg:-right-40 lg:top-52 lg:scale-x-600 lg:scale-y-150'"/>
    <div class="grid-basic items-center">
        <div class="col-start-2 col-end-7 md:col-start-7 md:col-end-12">
            <x-header-image/>
        </div>
        <div class="col-start-2 col-end-7 md:row-start-1 lg:col-end-6">
            <h2 id="home-page-title" class="big-title">
                {!! __('headings.header_title') !!}
            </h2>
            <p class="text-content text-center md:text-left my-5">
                {!! __('content.header_content') !!}
            </p>
            <div class=" flex flex-col md:flex-row gap-4">
                <x-button :route="''" :label="__('label.adopt')" :type="'light'"/>
                <x-button :route="''" :label="__('label.learn_more')" :type="'dark'"/>
            </div>
        </div>
    </div>
</section>
