@php use function PHPUnit\Framework\isArray; @endphp
<div class="px-3 py-1 bg-softGray/60 rounded-xl flex justify-start gap-3 items-center">
    <div class="w-fit">
        <dt class="font-bold">{!! $label !!}</dt>
        @if(is_a($value, 'Illuminate\Database\Eloquent\Collection'))
            @foreach($value as $v)
                <dd class="inline">{{$v->name}}</dd>
            @endforeach
        @else
            <dd>{!! $value !!}</dd>
        @endif
    </div>
</div>
