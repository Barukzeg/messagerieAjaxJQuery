<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Messagerie instantanée</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>

        // Fonction d'envoi du message
        function enregistrerMessage(){
            var pseudo = $("#pseudo").val();
            var phrase = $("#message").val();
            $.get("src/enregistrer.php", {pseudo: pseudo, phrase: phrase}, function(data){
                $("#message").val(''); // Efface le champ de saisie
            });
        }
        
        function recupererMessages(){
            $.get("src/recuperer.php", function(data){
                $(".liste-messages").html(data);
            });
        }
        $(document).ready(function(){
            // Envoi du message lors du click sur le bouton Envoyer
            $("#envoyer").click(function(){
                enregistrerMessage();
            });
            $("message").keyup(function(e){
                if(e.keyCode == 13){
                    enregistrerMessage();
                }
            });
        });
        setInterval($.load("src/recuperer.php"), 2000);
    </script>
</head>
<body>
    <div class="input" id="top">
        <h5>Pseudonyme : </h2>
        <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
    </div>
    <div class="liste-messages">
        <?php
            include("src/recuperer.php");
        ?>
    </div>
    <div class="input" id="input-text">
        <input type="text" name="message" id="message" placeholder="Entrez votre message">
        <button id="envoyer">Envoyer</button>
    </div>
</body>
</html>