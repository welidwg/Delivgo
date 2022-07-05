<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>

    <p>
        Hello dear {{ $details['name'] }}. <br>
        You have requested to recover your password {{ date('Y-m-d') }} at {{ date('H:i:s') }} <br>
        To continue , here is the code below that you need to copy it into his field. <br>
        <span style="color: darkred">PS: This code will expire in 15 minutes !</span>
    </p>
    <br>


    @if ($details['code'] != '')
        <span> Code : <strong>{{ $details['code'] }}</strong> </span>
    @endif
    <br>
    <span>Delivero Stuff.</span>
</body>

</html>
