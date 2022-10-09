<?php session_start();

    include_once('mysql.php');
    include_once('functions.php');
    include_once('variables.php');


$getData = $_GET;

#On vérifie si la recette est bien présente
#et que l'id est bien numérique

if (!isset($getData['id']) && is_numeric($getData['id']))
{
    echo('Il faut un identifiant de recette pour le modifier.');
    return;
}


#On récupère les données de l'élément de l'identifiant choisi
#car on va les remettre dans le formulaire de modification

$retrieveRecipeStatement = $mysqlClient->prepare('SELECT * FROM recipes WHERE recipe_id = :id');
$retrieveRecipeStatement->execute([
    'id' => $getData['id'],
    
]) or die(print_r($db->errorInfo()));

$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de recettes - Edition de recette</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <!--Note : 'recipe_id' est l'id de la recette dans la base de données-->

    <div class="container">

        <?php include_once('header.php'); ?>

        <h1>Mettre à jour <?php echo($recipe['title']); ?> </h1>
        <form action="post_update.php" method="POST">

            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de la recette</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($recipe['recipe_id']); ?>">
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Titre de la recette</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo($recipe['title']); ?>">
            </div>

            <div>
                <label for="recipe" class="form-label">Description de la recette</label>
                <textarea class="form-control" placeholder="Votre description" id="recipe" name="recipe">
                    <?php echo strip_tags($recipe['recipe']); ?>
                </textarea>  
            </div>

            <input type="submit" class="btn btn-primary" value="Envoyer">
        </form>

    </div>


</body>
</html>