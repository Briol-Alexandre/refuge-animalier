@props(['label', 'idName', 'options', 'class'=>null])
<div class="flex flex-col w-full {{$class}}">
    <label for="{{$idName}}">
        {!! $label !!}
    </label>
    <select name="{{$idName}}" id="{{$idName}}" class="px-2 py-1 bg-white border-2 border-main-yellow rounded-lg">
        @foreach($options as $option)
            <option value="{{$option['value']}}">{{$option['name']}}</option>
        @endforeach
    </select>
</div>
