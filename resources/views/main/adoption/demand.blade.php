<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite(['resources/css/app.css'])
        <title>Demande d'adoption</title>
    </head>
    <body>
        <div class="logo">
            <x-logo/>
        </div>
        <h1>Nouvelle demande d'adoption</h1>
        <b>Animal concerné : {{$animal->name}}</b>
        <b>Adoptant :</b>
        <ul>
            <li>
                <b>Nom de l'adoptant :</b> {{$data['first_name']}} {{$data['last_name']}}
            </li>
            <li>
                <b>Email de l'adoptant :</b>
                <a href="mailto:{{$data['email']}}">
                    {{$data['email']}}
                </a>
            </li>
            <li>
                <b>Numéro de téléphone de l'adoptant :</b> <a href="tel:{{$data['tel']}}">{{$data['tel']}}</a>
            </li>
        </ul>
        <b>Prise de contact</b>
        <p>{{$data['message']}}</p>

        <a href="{{route('adoptions.index')}}">
            Accéder à l'adoption
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

