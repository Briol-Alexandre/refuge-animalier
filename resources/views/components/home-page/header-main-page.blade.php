<section aria-labelledby="home-page-title" class="relative">
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
