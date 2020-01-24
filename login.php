<?php
    session_start();

    //Als de gebruiker al ingelogd is, heeft hij geen toegang tot de pagina
    if( isset($_SESSION['user'])){
        require_once "lib/autoload_lib.php";
        $_SESSION['msg'] =  "Je bent al ingelogd.";
        header("Location: beheer.php");
    } else {
        require_once "lib/autoload.php";
        print LoadTemplate("login");
        print LoadTemplate("scroll_to_top");
        print LoadTemplate("basic_footer");
    }

?>