@props(['title' => null, 'btnLabel' => null, 'animalId'])

<section aria-labelledby="adoption-form" class="grid-basic">
    <h2 id="adoption-form" class="col-span-full title text-center !mb-0">
        {!! $title !!}
    </h2>
    <p class="col-span-full text-center mb-4 max-md:px-8">{!! __('animal_form.intro') !!}</p>

    <form action="{{ route('animals.client.demand', 1) }}" method="post"
          class="col-span-full max-md:px-8 md:col-start-3 md:col-end-11 grid grid-cols-2 gap-x-4 lg:gap-x-11 gap-y-4">
        @csrf

        <input type="hidden" name="animal_id" value="{{$animalId}}">

        <div>
            <x-form.input :name-id="'last_name'" type="'text'" :label="__('contact.last_name')"
                          :placeholder="__('contact.placeholder_last_name')" />
            @error('last_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-form.input :name-id="'first_name'" type="'text'" :label="__('contact.first_name')"
                          :placeholder="__('contact.placeholder_first_name')" />
            @error('first_name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-form.input :name-id="'email'" type="'email'" :label="__('contact.email')"
                          :placeholder="__('contact.placeholder_email')" />
            @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <x-form.input :name-id="'tel'" type="'tel'" :label="__('contact.phone')"
                          :placeholder="__('contact.placeholder_phone')" />
            @error('tel')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="col-span-full">
            <x-form.input-textaria :input-class="'min-h-32'" :name-id="'message'"
                                   :label="__('contact.message_label')" :placeholder="__('contact.message_placeholder')" />
            @error('message')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="button-light place-self-end col-span-full">
            {!! $btnLabel !!}
        </button>
    </form>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
</section>
