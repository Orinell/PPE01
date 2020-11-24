<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="CSS/PPE_CSS_2019.css" rel="stylesheet" type="text/css" /> 
        <title>Les Genets Chevaux</title>
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

        <!-- tri chevaux -->
        <div class="test1">
            <form action="php_chevaux.php" method="post">
                <div class="tri">
                Trier par: 
                    <!-- liste déroulante -->
                    <p class="placetri">
                        <select class="form-control-cheval" name="choix">
                            <option value="Box ↓"></option>
                            <option value="Box ↓">Box ↓</option>
                            <option value="Box ↑">Box ↑</option>
                            <option value="Nom ↓">Nom ↓</option>
                            <option value="Nom ↑">Nom ↑</option>   
                            <option value="age ↓">age ↓</option>                         
                            <option value="age ↑">age ↑</option>
                        </select>
                    </p>

                    <!-- boutton ok -->
                    <p class="placeok">
                        <input type="submit" class="btn-success" value="OK" />
                    </p>

                    <!-- tri actif -->
                    <p class="placeok">
                        <?php
                            ini_set('display_errors', 'off'); /* Masque l'erreur due au fait que tricheval est vide*/
                            $tricheval = $_POST['choix'];

                            echo '
                            <div class="triactif">'.
                            $tricheval
                            .'</div>';

                        ?>
                    </p>
                </div>
            </form>
        </div>    

        <!-- Affichage liste chevaux -->
        <div class="listecheval">
            <?php

                //variables
                $tricheval = $_POST['choix'];

                //connection bdd
                try{
                    $bdd = new PDO('mysql:host=localhost;dbname=ppe;port=3306','root', '', array (PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
                }
                catch (Exception $e){
                    die('Erreur : ' . $e->getMessage());
                }

                //requete
                switch ($tricheval){
                    case $tricheval == 'Box ↓';
                        $reponse = $bdd->query('SELECT * FROM cheval ORDER BY RefBox');
                        break;
                    case $tricheval == 'Box ↑';
                        $reponse = $bdd->query('SELECT * FROM cheval ORDER BY RefBox DESC');
                        break;
                    case $tricheval == 'Nom ↓';
                        $reponse = $bdd->query('SELECT * FROM cheval ORDER BY NomCheval');
                        break;
                    case $tricheval == 'Nom ↑';
                        $reponse = $bdd->query('SELECT * FROM cheval ORDER BY NomCheval DESC');
                        break;
                    case $tricheval == 'age ↓';
                        $reponse = $bdd->query('SELECT * FROM cheval ORDER BY DateNaissance DESC');
                        break;
                    case $tricheval == 'age ↑';
                        $reponse = $bdd->query('SELECT * FROM cheval ORDER BY DateNaissance');
                        break;
                }

                //Affichage

                function age($date) { 
                    $age = date('Y') - $date; 
                if (date('md') < date('md', strtotime($date))) { 
                    return $age - 1; 
                } 
                return $age; 
                } 

                while ($donnees = $reponse->fetch()){
            ?>
                <div>

                    <!-- image cheval -->
                    <p class="flotte">
                    <img src="<?php echo $donnees['image']; ?>"" height="120px" width="120px "> 
                    </p>

                    <!-- info cheval -->
                    <p class="cheval">
                    <br><strong>Cheval</strong> : <?php echo $donnees['NomCheval']; ?><br />
                    Sexe : <?php echo $donnees['Sexe']; ?><br />
                    Age :   <?php 
                        
                                $agecheval = $donnees['DateNaissance'];

                                echo age("$agecheval").' ans';

                            ?><br />
                    Race : <?php echo $donnees['Race']; ?><br />
                    Robe : <?php echo $donnees['Robe']; ?><br />
                    Box : <?php echo $donnees['RefBox']; ?><br><br>
                    </p> 
                </div>
            <?php
                }

                //Fin du traitement de la requête
                $reponse->closeCursor();
                
                //Fermeture cession
                $bdd = null;
            ?> 
        </div>
        
        
    </body> 
</html>