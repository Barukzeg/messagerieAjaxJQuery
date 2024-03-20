<?php

    $server = "localhost";
    $db = "messagerie";
    $login = "root";
    $mdp = "";
    
    if(isset($_GET['pseudo']) && isset($_GET['phrase'])) {
        //Recuperation des donnees dans l'url
        $pseudo = $_GET['pseudo'];
        $phrase = $_GET['phrase'];

        //Connexion a la base de donnees
        try{
            $connection = new PDO("mysql:host=$server;dbname=$db", $login, $mdp);

            try{
                $query = $connection->prepare("INSERT INTO chatjs(contenu, userPseudo, horaire) VALUES(:phrase, :pseudo, :heure)");

                $query->bindparam(':phrase', $phrase);
                $query->bindparam(':pseudo', $pseudo);
                $currentDateTime = date('Y-m-d H:i:s');
                $query->bindparam(':heure', $currentDateTime);

                $query->execute();
            }catch(PDOException $e){
                echo "Erreur d'execution de la requete";
            }

        }catch(PDOException $e){
            echo "Erreur de connexion a la base de donnees";
        }

    }

?>