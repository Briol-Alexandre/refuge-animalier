@php use Carbon\Carbon; @endphp
@props(['datas'])
@php
    $logo = public_path('assets/img/svg/logo.svg');
    $hearthSvg = public_path('assets/img/svg/hearth.svg');
    $pawSvg = public_path('assets/img/svg/paw.svg');
    $handSvg = public_path('assets/img/svg/hand.svg');
    $vaccineSvg = public_path('assets/img/svg/vaccine.svg');
    $volunteerSvg = public_path('assets/img/svg/volunteer.svg');
    if ($datas['month']) {
        $parsedMonth = ucfirst(Carbon::createFromFormat('m', $datas['month'])->TranslatedFormat('F'));
    } else {
        $parsedMonth = null;
    }
@endphp

<div class="pdf-container">
    <div class="header">
        <div class="logo_container">
            <span class="logo">
                @inlinedImage($logo)
            </span>
        </div>
        <h1>Rapport {{$datas['month'] ? 'mensuel' : 'annuel'}}</h1>
        @if($parsedMonth)
            <p class="period">{{ $parsedMonth }} {{ $datas['year'] }}</p>
        @else
            <p class="period">{{ $datas['year'] }}</p>
        @endif
    </div>

    <div class="stats-grid">
        <div class="key-card">
            <div class="icon-circle bg-main-red-opacity">
                @if(file_exists($hearthSvg))
                    @inlinedImage($hearthSvg)
                @else
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"
                            fill="#FF6E6E"/>
                    </svg>
                @endif
            </div>
            <div class="card-content">
                <b class="number text-main-red">{{ $datas['adopted'] }}</b>
                <h2 class="label">Animaux adoptés</h2>
            </div>
        </div>

        <div class="key-card">
            <div class="icon-circle bg-main-yellow-opacity">
                @if(file_exists($pawSvg))
                    @inlinedImage($pawSvg)
                @else
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM6 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"
                            fill="#F6C449"/>
                    </svg>
                @endif
            </div>
            <div class="card-content">
                <b class="number text-main-yellow">{{ $datas['available'] }}</b>
                <h2 class="label">Animaux disponibles</h2>
            </div>
        </div>

        <div class="key-card">
            <div class="icon-circle bg-main-blue-opacity">
                @if(file_exists($handSvg))
                    @inlinedImage($handSvg)
                @else
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M23 5.5V20c0 2.2-1.8 4-4 4h-7.3c-1.08 0-2.1-.43-2.85-1.19L1 14.83s1.26-1.23 1.3-1.25c.22-.19.49-.29.79-.29.22 0 .42.06.6.16.04.01 4.31 2.46 4.31 2.46V4c0-.83.67-1.5 1.5-1.5S11 3.17 11 4v7h1V1.5c0-.83.67-1.5 1.5-1.5S15 .67 15 1.5V11h1V2.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5V11h1V5.5c0-.83.67-1.5 1.5-1.5s1.5.67 1.5 1.5z"
                            fill="#9747FF"/>
                    </svg>
                @endif
            </div>
            <div class="card-content">
                <b class="number text-main-blue">{{ $datas['animal'] }}</b>
                <h2 class="label">Animaux recueillis</h2>
            </div>
        </div>

        <div class="key-card">
            <div class="icon-circle bg-main-lightBlue-opacity">
                @if(file_exists($vaccineSvg))
                    @inlinedImage($vaccineSvg)
                @else
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19 3h-3V1h-2v2h-4V1H8v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H6v-1c0-2 4-3.1 6-3.1s6 1.1 6 3.1v1z"
                            fill="#00D4FF"/>
                    </svg>
                @endif
            </div>
            <div class="card-content">
                <b class="number text-main-lightBlue">{{ $datas['cure'] }}</b>
                <h2 class="label">Animaux en soin</h2>
            </div>
        </div>
        <div class="key-card">
            <div class="icon-circle bg-main-yellow-opacity">
                @if(file_exists($volunteerSvg))
                    @inlinedImage($volunteerSvg)
                @else
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19 3h-3V1h-2v2h-4V1H8v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H6v-1c0-2 4-3.1 6-3.1s6 1.1 6 3.1v1z"
                            fill="#00D4FF"/>
                    </svg>
                @endif
            </div>
            <div class="card-content">
                <b class="number text-main-yellow">{{ $datas['volunteer'] }}</b>
                <h2 class="label">Nouveaux bénévoles</h2>
            </div>
        </div>
        <div class="key-card">
            <div class="icon-circle bg-main-lightBlue-opacity">
                @if(file_exists($pawSvg))
                    @inlinedImage($pawSvg)
                @else
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M19 3h-3V1h-2v2h-4V1H8v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-7 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm6 12H6v-1c0-2 4-3.1 6-3.1s6 1.1 6 3.1v1z"
                            fill="#00D4FF"/>
                    </svg>
                @endif
            </div>
            <div class="card-content">
                <b class="number text-main-lightBlue">{{ $datas['animal_total'] }}</b>
                <h2 class="label">Animaux au total</h2>
            </div>
        </div>
    </div>
</div>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: "New Atten Round", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        color: #333;
        line-height: 1.6;
    }

    .pdf-container {
        padding: 40px;
        max-width: 800px;
        margin: 0 auto;
    }

    /* En-tête */
    .header {
        text-align: center;
        margin-bottom: 40px;
        padding-bottom: 25px;
        border-bottom: 2px solid #e5e7eb;
    }

    .logo_container {
        margin-bottom: 15px;
    }

    .logo {
        display: inline-block;
    }

    .logo img,
    .logo svg {
        width: 180px;
        height: auto;
        max-width: 100%;
    }

    h1 {
        font-size: 32px;
        font-family: "New Atten Round", sans-serif;
        color: #1f2937;
        margin-bottom: 8px;
        font-weight: 900;
    }

    .period {
        font-size: 18px;
        color: #6b7280;
        font-weight: 600;
    }

    /* Grille de statistiques */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        margin-bottom: 40px;
    }

    .key-card {
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        gap: 16px;
        min-height: 100px;
    }

    .icon-circle {
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .icon-circle svg,
    .icon-circle img {
        width: 24px;
        height: 24px;
    }

    /* Couleurs d'opacité pour les cercles - VOS COULEURS */
    .bg-main-red-opacity {
        background-color: rgba(255, 110, 110, 0.1);
    }

    .bg-main-yellow-opacity {
        background-color: rgba(246, 196, 73, 0.1);
    }

    .bg-main-blue-opacity {
        background-color: rgba(151, 71, 255, 0.1);
    }

    .bg-main-lightBlue-opacity {
        background-color: rgba(0, 212, 255, 0.1);
    }

    .card-content {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .number {
        font-family: "New Atten Round", sans-serif;
        font-size: 28px;
        font-weight: 900;
        line-height: 1.2;
    }

    .label {
        font-size: 14px;
        color: #6b7280;
        line-height: 1.2;
        font-weight: 400;
    }

    /* Couleurs des textes - VOS COULEURS */
    .text-main-red {
        color: #FF6E6E;
    }

    .text-main-yellow {
        color: #F6C449;
    }

    .text-main-blue {
        color: #9747FF;
    }

    .text-main-lightBlue {
        color: #00D4FF;
    }

    /* Pied de page */
    .footer {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid #e5e7eb;
        margin-top: 20px;
    }

    .footer p {
        font-size: 11px;
        color: #9ca3af;
    }
</style>
