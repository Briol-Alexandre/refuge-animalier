<x-layouts.client-layout>
    <x-animal-page.header :name="'J-P. Rouve'" />
    <x-animal-page.description-section :name="'J-P. Rouve'" :desc="'Voici J-P Rouve, un magnifique Golden Retriever au pelage doré et au cœur encore plus grand que son sourire. Âgé de quelques années, ce tendre compagnon est un vrai concentré de douceur, de joie et de loyauté. Toujours heureux de voir du monde, J-P accueille chaque visite avec une queue qui remue sans arrêt et un regard plein d’amour.
        Sociable, calme et affectueux, il s’entend à merveille avec les enfants et les autres animaux. Il aime les longues promenades, les séances de jeux dans le jardin et surtout… les câlins à n’en plus finir. C’est un chien équilibré, proche de l’humain, qui cherche avant tout à faire plaisir et à partager son quotidien avec une famille bienveillante.
        J-P Rouve a connu quelques moments difficiles, mais il n’a rien perdu de sa confiance ni de sa joie de vivre. Il attend aujourd’hui une famille patiente et aimante, prête à lui offrir un foyer chaleureux et à lui donner toute l’attention qu’il mérite. En retour, il vous offrira un amour sincère et une fidélité sans limites.
        Si vous rêvez d’un compagnon doux, joyeux et toujours partant pour une caresse, J-P Rouve est fait pour vous. Venez le rencontrer — son regard risque bien de vous faire craquer.'" />
    <x-animal-page.photos :name="'J-P. Rouve'" :images="[
        ['url' => asset('assets/img/dog.png'), 'alt' => __('content.image_of', ['name' => 'J-P. Rouve'])],
        ['url' => asset('assets/img/dog.png'), 'alt' => __('content.image_of', ['name' => 'J-P. Rouve'])],
        ['url' => asset('assets/img/dog.png'), 'alt' => __('content.image_of', ['name' => 'J-P. Rouve'])],
    ]" />
    <x-animal-page.form :title="__('animal_form.title')" :btn-label="__('contact.submit')" />
</x-layouts.client-layout>