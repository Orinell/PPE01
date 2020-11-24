<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
         <link href="CSS/PPE_CSS_2019.css" rel="stylesheet" type="text/css" /> 
        <title>Les Genets Acceuil</title>
    </head>

    <body>
    <meta charset="UTF-8">
        <!-- entete -->
    <div class="toppp">
        <div class ="entete">
            <font size="+4"><b><u><center>Centre Equestre LES GENETS</center></u></b></font>
        </div>

         <!-- menu -->
        <div class ="menu">
            <a href="php_acceuil.php"><input type="button" class="btn-success" value="Accueil" ></a>
            <a href="php_chevaux.php"><input type="button" class="btn-success" value="Chevaux" ></a>
            <a href="php_prestations.php"><input type="button" class="btn-success" value="Prestations" ></a>            
            <a href="php_contact.php"><input type="button" class="btn-success" value="Contact" ></a>
            <a href="php_espace_client.php"><input type="button" class="btn-success" value="Espace Client" ></a>
        </div>
    </div>

        <div class="espclient">
            <a href="php_espace_client.php"><input type="button" class="btn-success" value="Retour" ></a>
        </div>


        <!-- INFO Client -->
        <form action="php_nouveau_compte.php" method="post">

        <!-- VARIABLES -->
        <?php
        ini_set('display_errors', 'off'); //empceche l'affichage erreur variables vides
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date = $_POST['date'];
        $adresse = $_POST['adresse'];
        $ville = $_POST['ville'];
        $cp = $_POST['cp'];
        $tel = $_POST['tel'];
        $mail = $_POST['mail'];
        $pass = $_POST['pass'];
        $passconf = $_POST['passconf'];
        ?>

        <!-- nom ENTREE -->
        <!-- <div class ="nom">         
            Nom : <br><br>
            Prenom : <br><br>
            Date de naissance : <br><br>
            Adresse : <br><br>
            Ville : <br><br>
            Code postal : <br><br>
            Téléphone : <br><br>
            Adresse mail : <br><br>
            Mot de passe : <br><br>
            Comfirmez : <br><br>
        </div> -->

        <!-- ENTREE client -->
        <div class="champ">       
        Nom : <input type="text" class="form-control" value= "<?php echo $nom; ?>" name="nom" /><br>
        Prenom : <input type="text" class="form-control" value= "<?php echo $prenom; ?>" name="prenom" /><br> 
        Date de naissance :     <input type="date" class="form-control" value= "<?php echo $date; ?>" name="date" /><br>     
        Adresse :     <input type="text" class="form-control" value= "<?php echo $adresse; ?>" name="adresse" /><br>    
        Ville :     <input type="text" class="form-control" value= "<?php echo $ville; ?>" name="ville" /><br>    
        Code postal :     <input type="text" class="form-control" value= "<?php echo $cp; ?>" name="cp" /><br>    
        Téléphone :     <input type="text" class="form-control" value= "<?php echo $tel; ?>" name="tel" /><br>    
        Adresse mail :     <input type="text" class="form-control" value= "<?php echo $mail; ?>" name="mail" /><br>    
        Mot de passe :     <input type="password" class="form-control" name="pass" /><br>    
        Confirmer le mot de passe :     <input type="password" class="form-control" name="passconf" /><br>  
            <input type="submit" class="btn-success" value="OK" /> 
        </div>

        <!-- ERREUR entree -->
        <div class="erreurs">
            <?php


                //compteur d'erreurs
                $i = 0;

                //longueur tel
                if (strlen($tel) != 10){
                    echo '* le numéro de téléphone doit contenir 10 chiffres <br>';
                }else{
                    $i++;
                }

                //tel entier ?
                $testtel = is_numeric($tel);
                if ($testtel == false){
                    echo '* le numéro de téléphone doit etre de type entier <br>';
                }else{
                    $i++;
                }

                //longueur cp
                 if (strlen($cp) != 5){
                    echo '* le cp doit contenir 5 chiffres <br>';
                }else{
                    $i++;
                }
                
                //cp entier ?
                $testcp = is_numeric($cp);
                if ($testcp == false){
                    echo '* le cp doit etre de type entier <br>';
                }else{
                    $i++;
                }

                //mail null ?
                if ($mail == null){
                    echo '* veulliez entrer une adresse mail <br>';
                }else{
                    $i++;
                }

                //longueur mot de passe
                if (strlen($pass) < 6 || strlen($pass) > 20){
                    echo '* le mot de passe doit etre compris entre 6 et 20 caractères <br>';
                }else{
                    $i++;
                }

                // mot de passe identique
                if ($pass != $passconf){
                    echo '* le mot de passe doit etre identique <br>';
                }else{
                    $i++;
                }

                // Si
                if ($i == 7){
                    //toutes les conditions réunies
                    //connection bdd
                    $bdd = new PDO('mysql:host=localhost;dbname=ppe;port=3306','root', '');

                    //commande SQL
                    $sql = 'INSERT INTO client VALUES ("", "'.$nom.'", "'.$prenom.'", "'.$adresse.'", "'.$ville.'", "'.$cp.'", "'.$tel.'", "'.$mail.'", "'.$pass.'","","'.$date.'")';
                    $bdd->query($sql) or die ('Erreur SQL !'.$sql.'<br />'.mysql_error());

                    //Fin du traitement de la requête
                    echo 'FELICITATION VOTRE COMPTE A BIEN ETE CREE';
                    $reponse->closeCursor();

                }else{
                    //conditions manquantes
                    echo '* un ou plusieurs champs sont incorrects veuillez les corriger';
                }

            ?>
        </div>
        

    </body> 
</html>