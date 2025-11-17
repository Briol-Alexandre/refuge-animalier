<li class="px-4 slider-item">
    <article
        class="key-card bg-white shadow-basic rounded-btn flex flex-col items-center justify-center py-2.5 mt-5"
        aria-labelledby="key-title-{{$title}}"
    >
        <div class="{{$opacity}} w-14 h-14 flex items-center justify-center rounded-full">
            {{$slot}}
        </div>
        <div class="flex flex-col items-center mt-2">
            <b class="bubble-number {{$color}}">{{$num}}</b>
            <h3 class="text-sm" id="key-title-{{$title}}">
                {{$title}}
            </h3>
        </div>
    </article>
</li>
