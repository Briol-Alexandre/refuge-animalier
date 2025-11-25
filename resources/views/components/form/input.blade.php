@props(['nameId'=>null, 'label'=>null, 'type'=>null, 'placeholder'=>null, 'class'=>null, 'inputClass'=>null])
<div class="flex flex-col {{$class}}">
    <label for="{{$nameId}}">{!! $label !!}</label>
    <input type="{{$type}}" name="{{$nameId}}" id="{{$nameId}}" placeholder="{{$placeholder}}" class="{{$inputClass}} p-2 bg-white border-2 border-main-yellow rounded-lg">
</div>
