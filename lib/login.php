<?php
require_once "autoload_lib.php";

$formname = $_POST["formname"];
$buttonvalue = $_POST['loginbutton'];
//Als de gegevens uit het juiste formulier komen
if ( $buttonvalue == "Log in" )
{
    if ( $buttonvalue == "Log in" ){

        //Functie ControleLoginWachtwoord gebruiken om het wachwoord te controleren
        if ( ControleLoginWachtwoord($_POST['use_email'], $_POST['use_wachtwoord']) ){
            $_SESSION['msg'] = "Welkom ".$_SESSION['user']['use_voornaam']."!";
            header('Location: ../beheer.php');
        }
        else
        {
            $_SESSION['msg'] = "Sorry! Verkeerde login of wachtwoord!";
            header('Location: ../login.php');
        }
    }
}
?>