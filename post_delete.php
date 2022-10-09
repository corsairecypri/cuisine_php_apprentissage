<?php 

include_once('mysql.php');
include_once('functions.php');
include_once('variables.php');

#On vérifie l'existence de l'id demandé

if (!isset($_POST['id']))
{
    echo 'Il faut un identifiant valide pour supprimer une recette.';
    return;
}

#On réalise la suppression

$id = $_POST['id'];

$deleteRecipeStatement = $mysqlClient->prepare('DELETE FROM recipes WHERE recipe_id = :id');
$deleteRecipeStatement->execute([
    'id' => $id,
]);

#On réalise une redirection vers la page Home
#(car la page supprimée n'existe plus)

header('Location: home.php');


?>