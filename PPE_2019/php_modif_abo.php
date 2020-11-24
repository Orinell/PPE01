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
            <a href="php_chevaux.php"><input type="button"class="btn-success"  value="Chevaux" ></a>
            <a href="php_prestations.php"><input type="button" class="btn-success" value="Prestations" ></a>            
            <a href="php_contact.php"><input type="button" class="btn-success" value="Contact" ></a>
            <a href="php_espace_client.php"><input type="button" class="btn-success" value="Espace Client" ></a>
        </div>
    </div>

    <!-- <a href="php_espace_client.php"><input type="button" class="btn-success" value="Retour espace client" ></a> -->



        <!-- Test connection/deconnection -->
        <div class="espclient">
        <?php

            session_start();

            ini_set('display_errors', 'off');
            if ($_SESSION['mail'] == ''){
                echo '<a href="php_connection.php"><input type="button" class="btn-success" value="connection"></a>';           //connection
                echo '<a href="php_nouveau_compte.php"><input type="button" class="btn-success" value="nouveau compte"></a><br>';   //nouveau compte
            }else{
                echo '<a href="php_deconnection.php"><input type="button" class="btn-success" value="deconnection" ></a>';          //déconnection
            }
            
        ?>
            <div class="espclient2">
            <a href="php_espace_client.php"><input type="button" class="btn-success" value="Retour" ></a>
        </div>
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
                die('non connecté');
            }
        ?>

<!-- espace client PAGE CONNECTE -->


    <!-- AFFICHAGE DES DIFFERANTS ABONEMENTS -->
    <font size="+2"><b><center>Nos abonnements</center></b></font>

            <!-- LISTE ABO -->

            <div class="carre"> 
                
                <?php
                
                $abo = 'SELECT * FROM abonement';
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
                    Des cours <?php echo $donnees['Condition']; ?><br />
                    </p> 
                    </div>
                <?php
                }

                //Fin du traitement de la requête
                //$reponse->closeCursor();
                    
                
                ?> 

            </div>

        <!-- LISTE ABO FIN -->
        

        <!-- MODIF ABO -->

            <div>
                <form action="php_modif_abo.php" method="post">
                    <div class="tri">
                        <!-- liste abo -->
                        <p class="selectabo">
                            Modifier mon abonnement : <select class="form-control2" name="Abo">
                                <option value="1">Résilier mon abonnement</option>
                                <option value="2">Abonnement Kid</option>
                                <option value="3">Abonnement Débutant</option>
                                <option value="4">Abonnement Club</option>                          
                            </select>
                        </p>

                        <!-- boutton ok -->
                        <p class="placeok2">
                            <input type="submit" class="btn-success" value="OK" />
                        </p>

                        <?php
                            ini_set('display_errors', 'off'); /* Masque l'erreur due au fait que Abo est vide*/
                            $triabo = $_POST['Abo'];

                            switch ($triabo){
                                case $triabo == '0';
                                    break;
                                 case $triabo == '1';
                                        $modifsql = 'UPDATE ppe.client SET RefAbo = "NULL" WHERE MailClient = "'.$_SESSION['mailclient'].'"';
                                        $bdd->query($modifsql) or die ('Erreur SQL !'.$modifsql.'<br />'.mysql_error());
                                    break;
                                case $triabo >= '2';
                                        $modifsql = 'UPDATE ppe.client SET RefAbo = "'.$triabo.'" WHERE MailClient = "'.$_SESSION['mailclient'].'"';
                                        $bdd->query($modifsql) or die ('Erreur SQL !'.$modifsql.'<br />'.mysql_error());
                                    break;
                            }
                            
                            
                        ?>
                    
                    </div>
                </from>
            </div>

            <?php




            /* A EXECUTER SI CONDITION OK 
            $modifsql = 'UPDATE ppe.client SET RefAbo = "'.$refabo'" WHERE client.MailClient = "'.$_SESSION['mailclient'].'"';
            $bdd->query($modifsql) or die ('Erreur SQL !'.$modifsql.'<br />'.mysql_error());
            */


            ?>

        <!-- MODIF ABO FIN -->
        


    </body> 
</html>