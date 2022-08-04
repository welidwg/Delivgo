<?php
use App\Models\User;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
        $email = $details['email'];
        $user = User::where('email', $email)->first();
    ?>

    <p>
        Bonjour <?php echo e($user->name); ?>. <br>
        L'équipe de Delivgo vous félicite pour votre approbation chez eux ! <br>
        Voila les détails de votre compte : <br>
        <strong>Nom :</strong><?php echo e($user->name); ?>.<br>
        <strong>Type :</strong><?php echo e($user->type == 2 ? 'Restaurant' : 'Livreur'); ?>.<br>
        <strong>Téléphone :</strong><?php echo e($user->phone); ?>.<br>
        <strong>Mot de passe :</strong><?php echo e($details['password']); ?><br>

        <span style="color: darkred">Nous vous souhaitons un bon travail.</span>
    </p>
    <br>
    <span>Equipe Delivgo.</span>
</body>

</html>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/emails/newAccount.blade.php ENDPATH**/ ?>