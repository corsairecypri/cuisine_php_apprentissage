<?php
session_start();

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

    include_once('functions.php');
    include_once('variables.php');

$postData = $_POST;

#On vérifie la présence de l'id, du titre et de la recette

if(
    !isset($postData['id'])
    || !isset($postData['title'])
    || !isset($postData['recipe'])
)
{
    echo('Il manque des informations pour permettre l\'édition du formulaire.');
    return;
}

#Il faut passer ces 3 éléments dans la requête

$id = $postData['id'];
$title = $postData['title'];
$recipe = $postData['recipe'];

$insertRecipeStatement = $mysqlClient->prepare('UPDATE recipes SET title = :title, recipe = :recipe WHERE recipe_id = :id');

$insertRecipeStatement->execute([
    'title' => $title,
    'recipe' => $recipe,
    'id' => $id,
]);

?>


