@php
use App\Models\User;
@endphp

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>
    @php
        $email = $details['email'];
        $user = User::where('email', $email)->first();
    @endphp

    <p>
        Bonjour {{ $user->name }}. <br>
        L'équipe de Delivgo vous félicite pour votre approbation chez eux ! <br>
        Voila les détails de votre compte : <br>
        <strong>Nom :</strong>{{ $user->name }}.<br>
        <strong>Type :</strong>{{ $user->type == 2 ? 'Restaurant' : 'Livreur' }}.<br>
        <strong>Téléphone :</strong>{{ $user->phone }}.<br>
        <strong>Mot de passe :</strong>{{ $details['password'] }}<br>

        <span style="color: darkred">Nous vous souhaitons un bon travail.</span>
    </p>
    <br>
    <span>Equipe Delivgo.</span>
</body>

</html>
