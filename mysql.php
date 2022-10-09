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

?>