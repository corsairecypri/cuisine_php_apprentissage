<?php

//Cherche l'adresse mail d'un auteur, et si elle la trouve
//elle affiche le nom et l'age de l'auteur

function display_author(string $authorEmail, array $users) : string
{
    for ($i = 0; $i < count($users); $i++) {
        $author = $users[$i];
        if ($authorEmail === $author['email']) {
            return $author['full_name'] . '(' . $author['age'] . ' ans)';
        }
    }
}


function isValidRecipe(array $recipe) : bool  //On utilise un tableau $recipe (recette) et on attend un booléen
{

    //On cherche d'abord l'existence de la clé "is_enabled"

    if (array_key_exists('is_enabled', $recipe)) {

        //Si cette clé existe, on stocke le résultat (true ou false) dans la variable $isEnable

        $isEnabled = $recipe['is_enabled'];
    } else {

        //Sinon isEnable vaut false pour éviter les bugs

        $isEnabled = false;
    }

    return $isEnabled;   //Et enfin on retourne $isEnable.
}

function get_recipes(array $recipes) : array
{
    $validRecipes = [];

    foreach($recipes as $recipe) {
        if (isValidRecipe($recipe)) {
            $validRecipes[] = $recipe;
        }
    }

    return $validRecipes;
}

?>