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
            // Recupere le pseudo et le message dans les inputs
            var pseudo = $("#pseudo").val();
            var phrase = $("#message").val();
            // Envoi des données à enregistrer.php
            $.get("src/enregistrer.php", {pseudo: pseudo, phrase: phrase}, function(data){
                $("#message").val(''); // Efface le champ de saisie
            });
        }

        // Fonction de récupération et d'affichage des messages
        // Avec listId en paramètre qui contient les id des messages déjà affichés
        function recupererMessages(listId){
            // Récupération des messages
            $.getJSON("src/recuperer.php", function(data){
                // Parcours des messages en sens inverse
                $.each(data.reverse(), function(index, message){
                    // Si le message n'est pas déjà affiché
                    if(!(listId.includes(message['idMessage']))){

                        // Ajout d'un séparateur entre chaque message sauf pour le premier
                        if (!(index === 0)){
                            $(".messages").append("<hr>");
                        }

                        // Affichage de chaque message
                        var date = new Date(message['horaire']);
                        str = date.toLocaleString();
                        $(".messages").append("<strong>" + message['userPseudo'] + "</strong> : "+ str +"<br>" + message['contenu']);
                        listId.push(message['idMessage']);
                        // Scroll automatique vers le bas du bloc
                        document.getElementById('msg').scrollBy(0, 1000);
                    }
                })
            })
        }


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
        }, 1000);

    </script>
</head>
<body>
    <div class="input-pseudo">
        <h5>Pseudonyme : </h2>
        <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">
    </div>
    <div class="liste-messages">
        <div class="display-messages" id="msg">
            <span class="messages">
            </span>
        </div>
    </div>
    <div class="input-message">
        <input type="text" name="message" id="message" placeholder="Entrez votre message">
        <button id="envoyer">Envoyer</button>
    </div>
</body>
</html>