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

        
        function recupererMessages(listId){
            $.getJSON("src/recuperer.php", function(data){
                $.each(data.reverse(), function(index, message){
                    if(!(listId.includes(message['idMessage']))){
                        console.log("id du dernier message : " + message['idMessage']);
                        console.log("liste des id : " + listId);
                        if (!(index === 0)){
                            $(".messages").append("<hr>");
                        }
                        $(".messages").append("<strong>" + message['userPseudo'] + "</strong> : "+message['horaire']+"<br> " + message['contenu']);
                        listId.push(message['idMessage']);
                    }
                })
            })
        }
/*
        function getLastMessage(){
            $.getJSON("src/recuperer.php", function(data){
                $.each(data.reverse(), function(index, message){
                    var id = []; // Tableau contenant les id des messages
                    for(var i = 0; i <= id.length; i++){
                        if(!(message['idMessage'] === id[i])){
                            $(".messages").append("<hr>");
                            $(".messages").append("<strong>" + message['userPseudo'] + "</strong> : "+message['horaire']+"<br> " + message['contenu']);
                            id.push(message['idMessage']);
                        }
                    }
                })
            });
        }
*/
        $(document).ready(function(){
            // Envoi du message lors du click sur le bouton Envoyer
            $("#envoyer").click(function(){
                enregistrerMessage();
            });
            // Envoi du message lors de l'appui sur la touche Entrée
            $("#message").keyup(function(e){
                if(e.keyCode == 13){
                    enregistrerMessage();
                }
            });
        });

        recupererMessages(listId = []);

        setInterval(function(){
            recupererMessages(listId);
        }, 2000);

    </script>
</head>
<body>
    <div class="input-pseudo">
        <h5>Pseudonyme : </h2>
        <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
    </div>
    <div class="liste-messages">
        <span class="messages">
        </span>
    </div>
    <div class="input-message">
        <input type="text" name="message" id="message" placeholder="Entrez votre message">
        <button id="envoyer">Envoyer</button>
    </div>
</body>
</html>