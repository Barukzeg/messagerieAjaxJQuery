<?php

    $server = "localhost";
    $db = "messagerie";
    $login = "root";
    $mdp = "";
    
    if(isset($_GET['pseudo']) && isset($_GET['phrase'])) {
        //Recuperation des donnees dans l'url
        $pseudo = $_GET['pseudo'];
        $phrase = $_GET['phrase'];

        $connection = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);

        $query = $connection->prepare("INSERT INTO messages(contenu, userPseudo, horaire) VALUES(:phrase, :pseudo, :heure)");

        $query->bindparam(':phrase', $phrase);
        $query->bindparam(':pseudo', $pseudo);
        $query->bindparam(':heure', now());

        $query->execute();
    }

?>