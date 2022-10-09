
<?php
require 'variables.php';

// Validation du formulaire
if (isset($_POST['email']) &&  isset($_POST['password'])) {

    foreach ($users as $user) {

        //ON vérifie les identifiants de l'utilisateur
        if (
            $user['email'] === $_POST['email'] &&
            $user['password'] === $_POST['password']
        ) {
            
            //On stocke l'email de l'utilisateur dans un tableau
            $loggedUser = [
                'email' => $user['email'],
            ];

            

            //On envoie ce tableau dans un cookie

            setcookie(
                'LOGGED_USER',
                $loggedUser['email'],
                [
                    'expires' => time() + 365*24*3600,
                    'secure' => true,
                    'httponly' => true,
                ]
            );

            //On stocke également l'email dans une session (les infos viennent du cookies)

            $_SESSION['LOGGED_USER'] = $loggedUser['email'];

        } else {
            $errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
                $_POST['email'],
                $_POST['password']
            );
        }
    }
}
?>

<!-- Si utilisateur/trice est non identifié(e), on affiche le formulaire-->

<?php if(!isset($_SESSION['LOGGED_USER'])): ?>   <!--Notez le if : ?-->

<form action="home.php" method="post">

    <!-- si message d'erreur on l'affiche -->
    <?php if(isset($errorMessage)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
        <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>

</form>

<!-- Si utilisateur/trice bien connectée on affiche un message de succès -->

<?php else: ?>   <!--Notez le else : ?-->       

    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $_SESSION['LOGGED_USER']; ?> et bienvenue sur le site !
    </div>

<?php endif; ?> <!--Notez le endif; ?--> 