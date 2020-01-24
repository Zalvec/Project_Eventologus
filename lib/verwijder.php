<?php
require_once "autoload_lib.php";

//De eve_id uit de get halen
foreach ($_GET as $field => $value){
    $eve_id = $field;
}

//Evenement met deze ID verwijderen
$sql = 'DELETE FROM evenement where eve_id = '.$eve_id;

//Afhankelijk van of de query goed wordt uitgevoerd een message weergeven
if (ExecuteSQL($sql)){
    $_SESSION['msg'] = 'Evenement is verwijderd!';
    header('Location: ../beheer.php');
} else{
    $_SESSION['msg'] = 'Er ging iets fout bij het verwijderen van het evenement, probeer opnieuw!';
    header('Location: ../beheer.php');
}