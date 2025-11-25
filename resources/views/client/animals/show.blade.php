<x-layouts.client-layout>
    <x-animal-page.header :name="'J-P. Rouve'"/>
    <x-animal-page.description-section :name="'J-P. Rouve'" :desc="'Voici J-P Rouve, un magnifique Golden Retriever au pelage doré et au cœur encore plus grand que son sourire. Âgé de quelques années, ce tendre compagnon est un vrai concentré de douceur, de joie et de loyauté. Toujours heureux de voir du monde, J-P accueille chaque visite avec une queue qui remue sans arrêt et un regard plein d’amour.
        Sociable, calme et affectueux, il s’entend à merveille avec les enfants et les autres animaux. Il aime les longues promenades, les séances de jeux dans le jardin et surtout… les câlins à n’en plus finir. C’est un chien équilibré, proche de l’humain, qui cherche avant tout à faire plaisir et à partager son quotidien avec une famille bienveillante.
        J-P Rouve a connu quelques moments difficiles, mais il n’a rien perdu de sa confiance ni de sa joie de vivre. Il attend aujourd’hui une famille patiente et aimante, prête à lui offrir un foyer chaleureux et à lui donner toute l’attention qu’il mérite. En retour, il vous offrira un amour sincère et une fidélité sans limites.
        Si vous rêvez d’un compagnon doux, joyeux et toujours partant pour une caresse, J-P Rouve est fait pour vous. Venez le rencontrer — son regard risque bien de vous faire craquer.'"/>
    <x-animal-page.photos
        :name="'J-P. Rouve'"
        :images="[
        ['url' => asset('assets/img/dog.png'), 'alt' => 'Image de J-P. Rouve'],
        ['url' => asset('assets/img/dog.png'), 'alt' => 'Image de J-P. Rouve'],
        ['url' => asset('assets/img/dog.png'), 'alt' => 'Image de J-P. Rouve'],
    ]"
    />
    <section aria-labelledby="adoption-form" class="grid-basic">
        <h2 id="adoption-form" class="col-span-full title text-center !mb-0">
            N’hésitez plus, adoptez le !
        </h2>
        <p class="col-span-full text-center mb-4 max-md:px-8">Remplissez ce formulaire et nous vous recontacterons après avoir analysé votre cas !</p>
        <form action="" method="post" class="col-span-full max-md:px-8 md:col-start-3 md:col-end-11 grid grid-cols-2 gap-x-4 lg:gap-x-11 gap-y-4">
            <x-form.input :name-id="'last-name'" type="'text'" :label="'Votre nom'" :placeholder="'Doe'"/>
            <x-form.input :name-id="'first-name'" type="'text'" :label="'Votre prénom'" :placeholder="'John'"/>
            <x-form.input :name-id="'email'" type="'email'" :label="'Votre adresse mail'" :placeholder="'john.doe@domain.com'"/>
            <x-form.input :name-id="'tel'" type="'tel'" :label="'Votre n° de téléphone'" :placeholder="'0444 44 44 44'"/>
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
