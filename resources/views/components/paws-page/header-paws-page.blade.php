@props(['title', 'content', 'img_path'])
<section aria-labelledby="paws-header" class="grid-basic items-center">
    <div class="col-start-2 col-end-7 md:col-end-6 flex flex-col gap-4">
        <h2 id="paws-header" class="big-title">
            {!! $title !!}
        </h2>
        <p class="text-content max-md:text-center">
            {!! $content !!}
        </p>
    </div>
    <img src="{{ $img_path }}" alt="{{ __('paws.image_alt') }}"
        class="col-start-2 col-end-7 md:col-start-7 md:col-end-12 rounded-btn-mobile md:rounded-btn">
</section>