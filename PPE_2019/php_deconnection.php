
<!-- PAGE DECONNECTION SESSION -->
<?php
    $bdd = null;
    session_start();
    $_SESSION['mail'] = '';
    $_SESSION['pass'] = '';
    $_SESSION['mailclient'] = '';     //mail du client connecté
    $_SESSION['passclient'] = '';     //pass du client connecté
    header('Location: http://localhost/ppe_test/web/php_espace_client.php');
    exit();
?>