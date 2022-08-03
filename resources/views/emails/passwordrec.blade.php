<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>

    <p>
        Bonjour chère {{ $details['name'] }}. <br>
        Vous avez demandé de récupérer votre mot de paase le {{ date('Y-m-d H:i a') }} <br>
        Pour continuez , ceci est le code que vous devez saisir au champs requis <br>
        <span style="color: darkred">Nb: Ce code sera expiré apràs 15 minutes !</span>
    </p>
    <br>


    @if ($details['code'] != '')
        <span> Votre code : <strong>{{ $details['code'] }}</strong> </span>
    @endif
    <br>
    <span>Equipe Delivgo.</span>
</body>

</html>
