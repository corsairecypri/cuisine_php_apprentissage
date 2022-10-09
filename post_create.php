<?php
session_start();
echo $_COOKIE['LOGGED_USER'];

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

?>



<?php 

include_once('variables.php');
include_once('functions.php');

//Vérification du formulaire soumis

if (
    !isset($_POST['title'])
    || !isset($_POST['recipe'])
    )

{
    echo "Il faut un nom de recette et une description pour envoyer la recette";
    return;
}

$title = $_POST['title'];
$recipe = $_POST['recipe'];

// Faire l'insertion en base

$insertRecipe = $mysqlClient -> prepare('INSERT INTO recipes(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)');

$insertRecipe -> execute([
    'title' => $title,
    'recipe' => $recipe,
    'is_enabled' => 1,
    'author' => $_COOKIE['LOGGED_USER'],
])

?>