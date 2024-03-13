<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Messagerie instantanée</title>
</head>
<body>
    <div class="input" id="top">
        <h5>Pseudonyme : </h2>
        <form action="index.php" method="post">
            <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
        </form>
    </div>
    <div class="liste-messages">
        <span>
            ahahahahhaha
        </span>
        <hr>
        <span>
            ahahahahhaha
        </span>
        <hr>
        <span>
            ahahahahhaha
        </span>
        <hr>
        <span>
            ahahahahhaha
        </span>
        <hr>
    </div>
    <div class="input" id="input-text">
        <form action="index.php" method="post">
            <input type="text" name="message" id="message" placeholder="Entrez votre message">
            <input type="submit" value="Envoyer">
        </form>
    </div>
</body>
</html>

<?php
    include_once("src/recuperer.php");
    include_once("src/enregistrer.php");

?>