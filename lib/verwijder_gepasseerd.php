<?php

require_once "autoload_lib.php";

//Evenement dat langer dat 6 dagen gepasseerd is verwijderen
$sql = "delete from evenement
        where eve_einddatum + 7 < date(now())";

//Afhankelijk van of de query goed wordt uitgevoerd een message weergeven
if (ExecuteSQL($sql)){
    $_SESSION['msg'] = "Evenementen die langer dan een week zijn afgelopen zijn verwijderd.";
    header('Location: ../beheer.php');
} else {
    $_SESSION['msg'] = "Er ging iets fout. Probeer opnieuw.";
    header('Location: ../beheer.php');
}