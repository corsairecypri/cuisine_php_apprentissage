 <!--Avant de faire des requêtes SQL, il faut lancer le système PDO-->

<?php
try
{
    
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


    <h1>Formulaire de recettes</h1>


    <form action="post_create.php" method="POST">

            
        <div class="mb-3">
            <label for="title" class="form-label">Nom de la recette</label>
            <input type="title" class="form-control" id="title" name="title" placeholder= "Nom de votre recette">
        </div>

        <div class="mb-3">
            <label for="recipe" class="form-label">Description de votre recette</label>
            <textarea class="form-control" placeholder="Votre description" id="recipe" name="recipe"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>

    </form>


    <?php include('footer.php'); ?>
        
</body>
</html>