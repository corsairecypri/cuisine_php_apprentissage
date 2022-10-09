<?php session_start(); ?>

<?php include_once('mysql.php'); ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <!-- Navigation -->
        <?php include_once('header.php'); ?>

        <h1>Site de Recettes !</h1>

        <!-- Inclusion du formulaire de connexion -->
        <?php include_once('login.php'); ?>

        <?php include_once('functions.php'); ?>
        

        <!-- Si l'utilisateur existe, on affiche les recettes -->
        <?php if(isset($loggedUser)): ?>
            
            <?php 
                
            #On récupére les recettes de la base de données

            $retrieveRecipeStatement = $mysqlClient->prepare('SELECT * FROM recipes');

            $retrieveRecipeStatement->execute() or die(print_r($db->errorInfo()));

            $recipes = $retrieveRecipeStatement->fetchAll();

            ?>


            <?php

                 foreach(get_recipes($recipes) as $recipe) : ?>
                <article>
                    <h3><?php echo $recipe['title']; ?></h3>
                    <div><?php echo $recipe['recipe']; ?></div>
                    <i><?php echo $recipe['author']; ?></i>

            <!--On ajoute un lien vers la page update.php qui récupère l'id, 
            et un autre qui permet sa suppression-->
            
                    <a href="update.php?id=<?php echo($recipe['recipe_id']); ?>">Modifier la recette</a>
                    <a href="delete.php?id=<?php echo($recipe['recipe_id']); ?>">Supprimer la recette</a>
                </article>
            <?php endforeach ?>
        <?php endif; ?>
    </div>


    <!--Partie pédagogique sur les jointures-->


    <!--
    <?php 
                

    // $data = $mysqlClient->prepare('SELECT u.full_name, c.comment 
    // FROM users u
    // INNER JOIN comments c
    // ON u.user_id = c.user_id
    // ORDER BY c.created_at DESC
    // LIMIT 10');

    // $data->execute() or die(print_r($db->errorInfo()));
    // $allComment = $data->fetchAll();

    // foreach ($allComment as $comment) {
        ?> 
    //     <p><?php // echo($comment['full_name']); ?></p>
    //     <p><?php // echo($comment['comment']); ?></p> <?php
    // }
    ?>

    -->
    <?php include_once('footer.php'); ?>

    
</body>
</html>