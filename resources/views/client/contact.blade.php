<x-layouts.client-layout>
    <section aria-labelledby="contact-title" class="grid-basic">
        <h2 id="contact-title" class="title col-span-full text-center">Une <strong>question</strong>, une <strong>demande</strong> ? Nous avons la <strong>réponse</strong> !</h2>
        <form action="" method="post" class="col-span-full max-md:px-8 md:col-start-3 md:col-end-11 grid grid-cols-2 gap-x-4 lg:gap-x-11 gap-y-4">
            <x-form.input :name-id="'last-name'" type="'text'" :label="'Votre nom'" :placeholder="'Doe'"/>
            <x-form.input :name-id="'first-name'" type="'text'" :label="'Votre prénom'" :placeholder="'John'"/>
            <x-form.input :name-id="'email'" type="'email'" :label="'Votre adresse mail'" :placeholder="'john.doe@domain.com'"/>
            <x-form.input :name-id="'tel'" type="'tel'" :label="'Votre n° de téléphone'" :placeholder="'044 44 44 44'"/>
            <x-form.select
                :label="'Objet de votre demande'"
                :id-name="'object'"
                :class="'col-span-full'"
                :options="[
                    ['value'=>'', 'name' => '--Choisir un sujet--'],
                    ['value'=>'subject-1', 'name' => 'Sujet 1'],
                    ['value'=>'subject-2', 'name' => 'Sujet 2']
                ]"
            />
            <x-form.input-textaria
                :class="'col-span-full'"
                :input-class="'min-h-32'"
                :name-id="'message'"
                :label="'Message <small>(cela nous permettra d’en savoir plus sur votre cas et vos motivations)</small>'"
                :placeholder="'Votre message ici…'"
            />
            <button class="button-light place-self-end col-span-full">
                Envoyer
            </button>
        </form>
    </section>
</x-layouts.client-layout>
