<span
    class="{{$class}} absolute z-20 bg-white rounded-small flex items-center justify-center gap-2 p-2 shadow-basic bubble w-max whitespace-nowrap">
    <div class="{{$opacity}} w-8 h-8 flex items-center {{$padding ? "pt-1" : ""}} justify-center rounded-full">
        {{$slot}}
    </div>
    <p class="flex flex-col justify-center-center text-xs leading-1 h-fit">
        <b class="{{$color}}">{{$num}}</b>
        {{$label}}
    </p>
</span>
