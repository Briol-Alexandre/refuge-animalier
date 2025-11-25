@props(['nameId'=>null, 'label'=>null, 'placeholder'=>null, 'class'=>null, 'inputClass'=>null])
<div class="flex flex-col {{$class}}">
    <label for="{{$nameId}}">{!! $label !!}</label>
    <textarea name="{{$nameId}}" id="{{$nameId}}" placeholder="{{$placeholder}}"
              class="{{$inputClass}} p-2 bg-white border-2 border-main-yellow rounded-lg"></textarea>
</div>
