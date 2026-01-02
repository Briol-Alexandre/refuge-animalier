<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css'])
        <title>Création de votre compte</title>
    </head>
    <body>
        <div class="logo">
            <x-logo/>
        </div>
        <h1>Création de votre compte</h1>
        <b>Voici vos coordonnées</b>
        <ul>
            <li>
                <b>Email :</b> {{$data['email']}}
            </li>
            <li>
                <b>Mot de passe</b>
                password
            </li>
        </ul>
        <b>VEUILLEZ CHANGER VOTRE MOT DE PASSE DIRECTEMENT APRÈS LA 1E CONNECTION</b>
        <a href="{{route('profile.edit')}}">
            Accéder aux notifications
        </a>

    </body>
    <style>
        body {
            font-family: Poppins, Arial, sans-serif;
        }

        h1 {
            font-family: "New Atten Round", sans-serif;
            font-size: 28px;
            text-align: center;
        }

        .logo {
            display: flex;
            justify-content: center;
        }
    </style>
</html>

