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
    <div class="toppp">
        <!-- entete -->
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
    

        <!-- Info Connection -->
        <?php
        ini_set('display_errors', 'off');
        $mail = $_POST['mail'];
        ?>
        <form action="php_connection.php" method="post">
        <div class ="conect">  
               
                Veuillez entrer votre mail<br>
                <input type="text" class="form-control" placeholder="name@example.com" value= "<?php echo $mail; ?>" name="mail" /><br><br>
                Veuillez entrer votre mot de passe<br>
                <input type="password" class="form-control" placeholder="Mot de passe" name="pass" /><br><br>           
                <input type="submit" class="btn-success" value="OK" />            
        </div>

        <!-- TEST connection avec compte de la bdd TEST -->
        <?php

        //START SESSION
        ini_set('display_errors', 'off');
        session_start();
        //$_SESSION['mail'] = $_POST['mail'];     //entée mail
        //$_SESSION['pass'] = $_POST['pass'];     //entée pass

        //connection bdd defaut
        $bddtest = new PDO('mysql:host=localhost;dbname=ppe;port=3306','root', '');

        //REQUETES SQL
        //MAIL
        $mailcomp = $bddtest->prepare('SELECT MailClient FROM client');
        $mailcomp->execute();
        //PASS
        $passsql = 'SELECT PassClient FROM client WHERE MailClient = "'.$_POST['mail'].'"';
        $passcomp = $bddtest->prepare($passsql);
        $passcomp->execute();

        // Mise en tableau array
        //MAIL
        $NomClient = array();
        While($data = $mailcomp->fetch()){
            $NomClient[] = $data['MailClient'];
        };
        //PASS
        $PassClient = array();
        While($data = $passcomp->fetch()){
            $PassClient[] = $data['PassClient'];
        };

        //Affichage tableau 
        /*
        //MAIL
        var_dump($NomClient); // Array
        echo '<br>';
        //PASS
        var_dump($PassClient); // Array
        echo '<br>';
        */

        //compteur
        $ii=0;
        //MAIL
        $nom = $_POST['mail'];
        if (in_array($nom, $NomClient)){
            //echo $nom.' est bien un client<br>';
            $ii++;
        }
        //PASS
        
        $pass = $_POST['pass'];
        if (in_array($pass, $PassClient)){
            //echo $pass.' est bien le mot de passe<br>';
            $ii++;
        }
        //echo $ii;

        //déco bdd client
        $bddtest = null;

        
        //connection bdd

        if ($ii==2){
            $_SESSION['mail'] = 'root';     //entée mail
            $_SESSION['pass'] = '';     //entée pass
            $sessmail = $_POST['mail'];
            $sesspass = $_POST['pass'];
            $_SESSION['mailclient'] = $sessmail;     //mail du client connecté
            $_SESSION['passclient'] = $sesspass;     //pass du client connecté
            
            $bdd = new PDO('mysql:host=localhost;dbname=ppe;port=3306',$_SESSION['mail'], $_SESSION['pass']);

            //SQL NUMCLIENT
                $sqlcli = 'SELECT * FROM client WHERE NomClient = "'.$_SESSION['mailclient'].'" && PassClient = "'.$_SESSION['passclient'].'"';
                $numclient = $bdd->query($sqlcli);
                while ($donnees2 = $numclient->fetch()){
                    $_SESSION['numclient'] = $donnees2['NumClient'];        //Numero du client connecté
                }   


            echo '
            <div>
            <br><font size="+2"><b><u><center>Félicitation ! vous etes connecté !</center></u></b></font><br>
            <center><a href="php_espace_client.php"><input type="button" class="btn-success" value="continuer" ></a>
            <a href="php_deconnection.php"><input type="button" class="btn-success" value="déconnection" ></a></center>
            </div>
            ';
        }else if ($ii==0 && ($_POST['mail'] || $_POST['pass']) == null ){
            echo '<br><font size="+1"><b><u><center>Veuillez entrer vos identifiants pour vous connecter</center></u></b></font><br>';
        }else{
            echo '<br><font size="+1"><b><u><center>Mail ou mot de passe incorrect</center></u></b></font><br>';
        }

        ?>


    </body> 
</html>