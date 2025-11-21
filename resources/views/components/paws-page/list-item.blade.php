<li class="relative group mt-11 md:mt-sectionPadding max-lg:last:mb-10">
    <x-svgs.arrow :class="'max-lg:hidden absolute -top-40 xl:-top-52 left-1/2 -translate-x-1/2 w-50 xl:w-72 h-auto group-even:-scale-x-100'"/>
    <article aria-labelledby="article_title" class="grid-basic items-center">
        <div class="col-start-2 col-end-7 md:col-end-12 group-odd:lg:col-start-7 group-odd:xl:col-start-8 group-odd:lg:col-end-12 group-even:lg:col-start-2 group-even:lg:col-end-7 group-even:xl:col-end-6">
            <h3 id="article_title" class="title text-center lg:text-left">
                {!! $header !!}
            </h3>
            <p class="text-center lg:text-left">
                {!!  $content !!}
            </p>
        </div>
        <div class="col-start-2 col-end-7 md:col-end-12 group-odd:lg:col-start-2 group-odd:lg:col-end-7 group-even:lg:col-start-7 group-even:lg-col-end-12 relative rounded-btn-mobile lg:row-start-1 aspect-video overflow-hidden ">
            <img src="{{asset('assets/img/shelter.png')}}" alt="Image du …"
                 class="absolute-position object-center object-cover">
        </div>

    </article>
</li>
