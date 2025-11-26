@props(['title'=>null, 'btnLabel'=>null])
<section aria-labelledby="adoption-form" class="grid-basic">
    <h2 id="adoption-form" class="col-span-full title text-center !mb-0">
        {!! $title !!}
    </h2>
    <p class="col-span-full text-center mb-4 max-md:px-8">Remplissez ce formulaire et nous vous recontacterons après
        avoir analysé votre cas !</p>
    <form action="" method="post"
          class="col-span-full max-md:px-8 md:col-start-3 md:col-end-11 grid grid-cols-2 gap-x-4 lg:gap-x-11 gap-y-4">
        <x-form.input :name-id="'last-name'" type="'text'" :label="'Votre nom'" :placeholder="'Doe'"/>
        <x-form.input :name-id="'first-name'" type="'text'" :label="'Votre prénom'" :placeholder="'John'"/>
        <x-form.input :name-id="'email'" type="'email'" :label="'Votre adresse mail'"
                      :placeholder="'john.doe@domain.com'"/>
        <x-form.input :name-id="'tel'" type="'tel'" :label="'Votre n° de téléphone'" :placeholder="'0444 44 44 44'"/>
        <x-form.input-textaria
            :class="'col-span-full'"
            :input-class="'min-h-32'"
            :name-id="'message'"
            :label="'Message <small>(cela nous permettra d’en savoir plus sur votre cas et vos motivations)</small>'"
            :placeholder="'Votre message ici…'"
        />
        <button class="button-light place-self-end col-span-full">
            {!! $btnLabel !!}
        </button>
    </form>
</section>
