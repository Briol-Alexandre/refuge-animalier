<section aria-labelledby="photos-{{$name}}" class="grid-basic max-md:mt-11">
    <h2 id="photos-{{$name}}" class="col-span-full title text-center">
        Photos de <strong>{{$name}}</strong>
    </h2>
    <div class="col-start-2 col-end-7 md:col-end-12 grid grid-cols-1 md:grid-cols-3 gap-2.5">
        @foreach($images as $img)
            <img src="{{$img['url']}}" alt="{{$img['alt']}}" class="rounded-btn">
        @endforeach
    </div>
</section>
