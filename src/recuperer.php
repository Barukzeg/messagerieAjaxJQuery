<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "messagerie";

    try {
        // Connexion à la base de données avec PDO
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        // Configuration de PDO pour afficher les exceptions en cas d'erreur
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Requête SQL pour récupérer les 10 derniers messages
        $sql = "SELECT contenu, userPseudo, horaire FROM chatJS ORDER BY idMessage DESC LIMIT 10";
        
        // Préparation de la requête
        $stmt = $conn->prepare($sql);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Récupération des résultats
        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Vérification s'il y a des résultats
        if (count($messages) > 0) {
            // Affichage des messages
            foreach ($messages as $message) {
                echo "Contenu: " . $message["contenu"] . " - Pseudo: " . $message["userPseudo"] . " - Horaire: " . $message["horaire"] . "<br>";
            }
        } else {
            echo "Aucun message trouvé.";
        }
    } catch(PDOException $e) {
        echo "Erreur de connexion: " . $e->getMessage();
    }

?>
