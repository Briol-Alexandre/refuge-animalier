@props(['title' => null, 'btnLabel' => null])
<section aria-labelledby="adoption-form" class="grid-basic">
    <h2 id="adoption-form" class="col-span-full title text-center !mb-0">
        {!! $title !!}
    </h2>
    <p class="col-span-full text-center mb-4 max-md:px-8">{!! __('animal_form.intro') !!}</p>
    <form action="" method="post"
        class="col-span-full max-md:px-8 md:col-start-3 md:col-end-11 grid grid-cols-2 gap-x-4 lg:gap-x-11 gap-y-4">
        <x-form.input :name-id="'last-name'" type="'text'" :label="__('contact.last_name')"
            :placeholder="__('contact.placeholder_last_name')" />
        <x-form.input :name-id="'first-name'" type="'text'" :label="__('contact.first_name')"
            :placeholder="__('contact.placeholder_first_name')" />
        <x-form.input :name-id="'email'" type="'email'" :label="__('contact.email')"
            :placeholder="__('contact.placeholder_email')" />
        <x-form.input :name-id="'tel'" type="'tel'" :label="__('contact.phone')"
            :placeholder="__('contact.placeholder_phone')" />
        <x-form.input-textaria :class="'col-span-full'" :input-class="'min-h-32'" :name-id="'message'"
            :label="__('contact.message_label')" :placeholder="__('contact.message_placeholder')" />
        <button class="button-light place-self-end col-span-full">
            {!! $btnLabel !!}
        </button>
    </form>
</section>