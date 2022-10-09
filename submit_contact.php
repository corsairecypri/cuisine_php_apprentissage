<?php session_start(); ?>

<!--Ce code permet de gérer 
    1) l'éventuel absence de l'email ou du message dans l'URL,
    2) puis de vérifier la validité de l'email 
    3) et enfin de rejeter les messages vides
-->

<?php

if (
    //Si l'email est absent de l'URL ou que l'email n'est pas valide

    (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 

    //Ou que le message soit absent de l'URL ou que le message soit vide
    
    || (!isset($_POST['message']) || empty($_POST['message']))
    )
{

	echo('Il faut un email et un message valides pour soumettre le formulaire.');
    return;
}



// On vérifie si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0)
{
    
    

    // On vérifie si le fichier n'est pas trop volumineux (s'il fait - d'un Mo)
    if ($_FILES['screenshot']['size'] <= 1000000)
    {
        // On vérifie si l'extension est autorisée
        $fileInfo = pathinfo($_FILES['screenshot']['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];

        if (in_array($extension, $allowedExtensions))
        {
            // On peut valider le fichier et le stocker définitivement
            move_uploaded_file($_FILES['screenshot']['tmp_name'], 'uploads/' . basename($_FILES['screenshot']['name']));
            echo "L'envoi a bien été effectué !";
        }
    }
    
}

/* Docu conséquente (vérification de l'extension)

La fonction pathinfo renvoie un tableau (array) contenant 
entre autres l'extension du fichier dans  $fileInfo['extension'] .

On stocke ça dans une variable  $extension .

Une fois l'extension récupérée, on peut la comparer à un tableau 
d'extensions autorisées, et vérifier si l'extension récupérée fait 
bien partie des extensions autorisées à l'aide de la fonction in_array() */

/*Docu conséquente (validation et stockage du fichier) 

Si tout est bon, on accepte le fichier en appelant  move_uploaded_file()  .

Cette fonction prend deux paramètres :

1) Le nom temporaire du fichier (on l'a avec $_FILES['screenshot']['tmp_name']  ).

2) Le chemin qui est le nom sous lequel sera stocké le fichier de façon définitive. 
On peut utiliser le nom d'origine du fichier $_FILES['screenshot']['name']  ou générer un nom au hasard.

On peut placer le fichier dans un sous-dossier « Uploads ». On souhaite garder le nom original du fichier.

Comme $_FILES['screenshot']['name'] contient le chemin entier vers le fichier d'origine 
( C:\dossier\fichier.png  , par exemple), il nous faudra extraire le nom du fichier.

On peut utiliser pour cela la fonction basename qui renverra juste « fichier.png ».*/


?>

<!--Code qui s'affiche quand tout se passe bien-->

<h1>Message bien reçu !</h1>
        
<div class="card-body">
    <h5 class="card-title">Rappel de vos informations</h5>

    <!--La fonction strip_tags permet de se protéger des attaques XSS (Cross-site scripting)
    Si jamais un hackeur tente d'injecter du code HTML avec du JS (via la balise <script>)
    strip_tags() neutralise les balises HTML < et >
    ce qui empêche l'exécution du code en le transformant en simple texte-->

    <p class="card-text"><b>Email</b> : <?php echo strip_tags($_POST['email']); ?></p>

    <p class="card-text"><b>Message</b> : <?php echo strip_tags($_POST['message']); ?></p>
</div>