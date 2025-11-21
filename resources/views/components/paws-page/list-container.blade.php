<section aria-labelledby="paws-list">
    <h2 id="paws-list" class="sr-only">
        {!! __('headings.paws-list-title') !!}
    </h2>
    <ul class="paws-items">
        <x-paws-page.list-item :header="__('headings.our-mission')" :content="__('content.our-mission-content')"/>
        <x-paws-page.list-item :header="__('headings.our-values')" :content="__('content.our-values-content')"/>
        <x-paws-page.list-item :header="__('headings.our-actions')" :content="__('content.our-action-content')"/>
    </ul>
</section>
