<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>

    <p>
        Hello dear {{ $details['name'] }}. <br>
        We are very honored and happy that you joined us ! <br>
        To Complete your inscription , we should verify your email , so all you have to do is just copy the code below
        into its indicated place on our website.
    </p>
    <br>


    @if ($details['code'] != '')
        <span> Your CODE : <strong>{{ $details['code'] }}</strong> </span>
    @endif
    <br>
    <span>Delivero Stuff.</span>
</body>

</html>
