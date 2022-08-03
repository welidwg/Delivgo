<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>

    <p>
        Bonjour chère {{ $details['name'] }}. <br>
        Nous sommes très honeureux que vous joignez nous. <br>
        Pour completez votre inscription, On doit verifier votre email , donc vous devez saisissez le code au dessus
        dans le champs requis.
    </p>
    <br>


    @if ($details['code'] != '')
        <span> Votre code : <strong>{{ $details['code'] }}</strong> </span>
    @endif
    <br>
    <span>Equipe delivgo.</span>
</body>

</html>
