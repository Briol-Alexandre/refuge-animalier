<section aria-labelledby="presentation-{{$name}}" class="grid-basic max-lg:mt-11">
    <h2 id="presentation-{{$name}}" class="col-span-full title text-center">
        {!! __('animal.presentation_of', ['name' => '<strong>' . $name . '</strong>']) !!}
    </h2>
    <p class="col-start-2 col-end-7 max-lg:text-center md:col-start-4 md:col-end-10 text-content">
        {{$desc}}
    </p>
</section>