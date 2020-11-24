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

        <!-- Test connection/deconnection -->
        <?php

            session_start();

            ini_set('display_errors', 'off');
            if ($_SESSION['mail'] == ''){
                echo '<a href="php_connection.php"><input type="button" class="btn-success" value="connection"></a> ';           //connection
                echo '<a href="php_nouveau_compte.php"><input type="button" class="btn-success" value="nouveau compte"></a><br>';   //nouveau compte
            }else{
                echo '<a href="php_deconnection.php"><input type="button" class="btn-success" value="deconnection" ></a>';          //déconnection
            }
        ?>
        </div>

        <!-- ouverture session  -->
        <!-- espace client PAGE NON CONNECTE (dans le die) -->
        <?php
            //connection bdd
            try{
                ini_set('display_errors', 'off');
                $bdd = new PDO('mysql:host=localhost;dbname=ppe;port=3306',$_SESSION['mail'], $_SESSION['pass'], array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'')); //array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'') pour afficher les accents
            }
            catch (Exception $e){
                die('
                    <div class="nonconnect">
                        Vous devez vous connecter pour accéder à cette page.
                    </div>
                ');
            }
        ?>

<!-- espace client PAGE CONNECTE -->


    <!-- MON PROFIL -->

    <div class="profil"> 
             
            <?php
             
            $profilsql = 'SELECT * FROM client WHERE MailClient = "'.$_SESSION['mailclient'].'" AND PassClient = "'.$_SESSION['passclient'].'"';
            $monprofil = $bdd->query($profilsql);
 
            while ($donnees = $monprofil->fetch()){
            ?>
                <div class="carre">

                <!-- info abo -->
                <p class="cheval">

                <br><br><strong>Mon profil : </strong><br />
                <br>Nom : <?php echo $donnees['NomClient']; ?><br />
                Prenom : <?php echo $donnees['PrenomClient']; ?><br />
                Age : <?php 
                
                    function age($date) { 
                        $age = date('Y') - $date; 
                    if (date('md') < date('md', strtotime($date))) { 
                        return $age - 1; 
                    } 
                    return $age; 
                    } 
                    $monage = $donnees['DateClient'];

                    echo age("$monage").' ans';

                ?><br />
                Adresse : <?php echo $donnees['AdrClient'].' '.$donnees['CpClient'].' '.$donnees['VilleClient']; ?><br />
                Téléphone : <?php echo $donnees['TelClient']; ?><br />
                Mail : <?php echo $donnees['MailClient']; ?><br />

                </p> 
                </div>
            <?php
            }
            ?> 
 
        </div>

    <!-- MON PROFIL FIN -->

    <!-- MODIFIER ABO -->
        <div class="modifabo">
        <a href="php_modif_abo.php"><input type="button" class="btn-success" value="Modifier mon abonnement"></a>
        </div>
    <!-- MODIFIER ABO FIN -->

    <!-- SANS ABONNEMENT TEST -->
    <?php

            $abocomp = $bdd->prepare('SELECT RefAbo FROM client WHERE MailClient = "'.$_SESSION['mailclient'].'" AND PassClient = "'.$_SESSION['passclient'].'"');
            $abocomp->execute();

            $RefAboClient = array();
            While($data = $abocomp->fetch()){
                $RefAboClient[] = $data['RefAbo'];
            };

            /*
            var_dump($RefAboClient); // Array
            echo '<br>';
            */

            if (in_array(0, $RefAboClient)){
                echo '
                    <div class="nonabo">
                        <br><font size="+2"><strong>aucun abonnement en cours</strong></font>
                    </div>
                ';
            }
    ?>

    <!-- SANS ABONNEMENT TEST FIN -->


    <!-- MON ABONNEMENT -->

        <div class="carre"> 
             
            <?php
            
            $abo = 'SELECT * FROM abonement INNER JOIN client ON abonement.RefAbo = client.RefAbo WHERE MailClient = "'.$_SESSION['mailclient'].'" AND PassClient = "'.$_SESSION['passclient'].'"';
            $monabo = $bdd->query($abo);

            while ($donnees = $monabo->fetch()){
            ?>
                <div class="carre">

                <!-- image abo -->
                <p class="flotte">
                <img src="<?php echo $donnees['ImageAbo']; ?>" height="120px" width="120px "> 
                </p>


                <!-- info abo -->
                <p class="cheval">
                <br><br><strong>Abonnement : </strong><?php echo $donnees['NomAbo']; ?><br />
                <strong>cours : </strong><?php echo $donnees['DateCour']; ?><br />
                <strong>Prix : </strong><?php echo $donnees['PrixAbo']; ?><br />
                </p> 
                </div>
                
            <?php
            
            }
            ?> 

        </div>

    <!-- MON ABONNEMENT FIN -->


    <!-- MON PROF -->

        <div class="carre">

    
            <?php
            

            $prof = 'SELECT * FROM prof INNER JOIN abonement ON prof.RefProf = abonement.RefProf INNER JOIN client ON abonement.RefAbo = client.RefAbo WHERE MailClient = "'.$_SESSION['mailclient'].'" AND PassClient = "'.$_SESSION['passclient'].'"';


            $monprof = $bdd->query($prof);

            while ($donnees = $monprof->fetch()){
            ?>
                <div class="carre">

                <!-- image prof -->

                <p class="flotte">
                <img src="<?php echo $donnees['ImageProf']; ?>" height="120px" width="120px ">  
                </p>

                <!-- info prof -->
                <p class="cheval">
                <br><br><strong>Prof : </strong><?php echo $donnees['PrenomProf'].' '.$donnees['NomProf']; ?></strong><br>
                <strong>Tel : </strong><?php echo $donnees['NumProf']; ?><br />
                <strong>Mail : </strong><?php echo $donnees['MailProf']; ?><br />

                </p> 
                </div>
            <?php
            }                
            ?> 

        </div>

    <!-- MON PROF FIN -->






    </body> 
</html>