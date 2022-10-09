<!--Ce bout de code permet de connecter le site à la base de données "We love food"
(et d'utiliser l'objet PDO) -->

<?php
try
{
    //On précise d'abord l'hôte (localhost), puis le nom de la database, puis utf-8.
    //Ensuite on précise l'identifiant de l'utilisateur (root) et son mot de passe (aucun).
    //Enfin la dernière ligne permet d'afficher les éventuelles erreurs dans les requêtes de manière
    //plus lisible. 

	$mysqlClient = new PDO(
        'mysql:host=localhost;      
        dbname=we_love_food;
        charset=utf8', 
        'root', 
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],
    );
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

/*Docu :On prépare une requête SQL, puis on l'exécute.
Puis avec fetchall(), on récupère les résultats dans une variable

$recipesStatement = $db->prepare('SELECT * FROM recipes');

$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll(); */


// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table recipes

// $sqlQuery = 'SELECT * FROM recipes WHERE author = "mickael.adrieu@exemple.com"  ';

// $recipesStatement = $mysqlClient->prepare($sqlQuery);
// $recipesStatement->execute();
// $recipes = $recipesStatement->fetchAll();

// On affiche la description de la recette avec leur auteur
// foreach ($recipes as $recipe) {

// ?>
    <p><?php //echo $recipe['recipe']. " ". $recipe['author']; ?>  </p>
 <?php
// }
// ?>

<!--Création d'un cookie de connexion-->

<?php
// retenir l'email de la personne connectée pendant 1 an
setcookie(
    'LOGGED_USER',
    'laurene.castor@exemple.com',
    [
        'expires' => time() + 365*24*3600,
        'secure' => true,
        'httponly' => true,
    ]
);
?>


<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site test</title>
    <!--Lien Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- inclusion de l'entête du site -->
    <?php include_once('header.php'); ?>

    <!-- inclusion des variables et fonctions -->
    <?php
        include_once('variables.php');
        include_once('functions.php');
    ?>


    <h1>Ma page web</h1>

    <p>Aujourd'hui nous sommes le <?php echo date('d/m/Y h:i:s'); ?>.</p>


    <div class="container">

        <h2>Affichage des recettes</h2>

        <!-- Boucle sur les recettes -->

        <!-- si la fonction getRecipe renvoie "vrai", on affiche ceci -->

        <!--NOTE IMPORTANTE : Pour voir comment on affiche ce genre de boucle plus simplement
        avec SQL, VOIR LA PAGE HOME-->

        <?php foreach(get_recipes($recipes) as $recipe) : ?>
            <article>
                <h3><?php echo $recipe['title']; ?></h3>
                <div><?php echo $recipe['recipe']; ?></div>
                <i><?php echo display_author($recipe['author'], $users); ?></i>
            </article>
        <?php endforeach ?>

        
    </div>   

    <h2>Formulaire de contact</h2>

    <form action="contact.php" method="POST">
        <!-- données à faire passer à l'aide d'inputs -->
        
        <input name="prenom" placeholder = "Votre prénom">
        <input name="nom" placeholder = "Votre nom">
    </form>
    
    <?php include('footer.php'); ?>
        
</body>
</html>