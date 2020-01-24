<?php

//Functie om message weer te geven als er een is
function ShowMessages()
{

    //weergeven messages
    if ( isset($_SESSION['msg']) )
    {
        $message = $_SESSION['msg'];
        $row = array( "message" => $message );
        $templ = LoadTemplate("message");
        print ReplaceContentRow( $row, $templ );
        unset($_SESSION['msg']);
    }
}