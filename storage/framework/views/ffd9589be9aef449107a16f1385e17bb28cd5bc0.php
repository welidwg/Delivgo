<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
</head>

<body>

    <p>
        Bonjour chère <?php echo e($details['name']); ?>. <br>
        Nous sommes très honeureux que vous joignez nous. <br>
        Pour completez votre inscription, On doit verifier votre email , donc vous devez saisissez le code au dessus
        dans le champs requis.
    </p>
    <br>


    <?php if($details['code'] != ''): ?>
        <span> Votre code : <strong><?php echo e($details['code']); ?></strong> </span>
    <?php endif; ?>
    <br>
    <span>Equipe delivgo.</span>
</body>

</html>
<?php /**PATH C:\wamp64\www\Delivgo\resources\views/emails/verification.blade.php ENDPATH**/ ?>