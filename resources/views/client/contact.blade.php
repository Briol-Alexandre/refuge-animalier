<x-layouts.client-layout>
    <section aria-labelledby="contact-title" class="grid-basic">
        <h2 id="contact-title" class="title col-span-full text-center">{!! __('contact.title') !!}</h2>
        <form action="{{route('contact.send')}}" method="post"
            class="col-span-full max-md:px-8 md:col-start-3 md:col-end-11 grid grid-cols-2 gap-x-4 lg:gap-x-11 gap-y-4">
            @csrf
            <x-form.input :name-id="'last-name'" type="'text'" :label="__('contact.last_name')"
                :placeholder="__('contact.placeholder_last_name')" />
            <x-form.input :name-id="'first-name'" type="'text'" :label="__('contact.first_name')"
                :placeholder="__('contact.placeholder_first_name')" />
            <x-form.input :name-id="'email'" type="'email'" :label="__('contact.email')"
                :placeholder="__('contact.placeholder_email')" />
            <x-form.input :name-id="'tel'" type="'tel'" :label="__('contact.phone')"
                :placeholder="__('contact.placeholder_phone')" />
            <x-form.select :label="__('contact.subject')" :id-name="'object'" :class="'col-span-full'" :options="[
        ['value' => '', 'name' => __('contact.subject_placeholder')],
        ['value' => 'volunteer', 'name' => __('contact.subject_1')],
        ['value' => 'other', 'name' => __('contact.subject_2')]
    ]" />
            <x-form.input-textaria :class="'col-span-full'" :input-class="'min-h-32'" :name-id="'message'"
                :label="__('contact.message_label')" :placeholder="__('contact.message_placeholder')" />
            <button class="button-light place-self-end col-span-full">
                {{ __('contact.submit') }}
            </button>
        </form>
    </section>
</x-layouts.client-layout>
