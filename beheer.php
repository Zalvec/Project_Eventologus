<?php

require_once "lib/autoload.php";

    print LoadTemplate("button_naar_aanmaken");

    //Het is niet mogelijk als niet aangemelde gebruiker de beheerpagina te openen
    if(!isset($_SESSION['user'])){
        $_SESSION['msg'] = 'Log u eerst in';
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php\">";
    }

    if (isset($_SESSION['user'])) {

        //MainTitle printen
        print "<h2 class=\"maintitle\">Uw evenementen</h2>";

        //SQL-code om alle evenementen die zijn aangemaakt door de ingelogde user, gesorteerd op begindatum, te selecteren
        $sql = "select * from evenement
            inner join user u on evenement.eve_use_id = u.use_id
            inner join locatie l on evenement.eve_loc_id = l.loc_id
            inner join postcode p on l.loc_pos_id = p.pos_id
            where use_email = '" . $_SESSION["user"]["use_email"] . "'
            order by eve_naam";
        $data = GetData($sql);

        //Geeft 'gratis' weer als de eve_minprijs 0 is, anders krijg je een tekst met de eve_minprijs in
        foreach ($data as $row => $value) {
            if ($value['eve_minprijs'] == 0) {
                $data[$row]['prijs'] = "Gratis";
            } else {
                $data[$row]['prijs'] = "Tickets vanaf: €" . $data[$row]['eve_minprijs'];
            }
        }

        //Geef de evenementen van de gebruiker weer, als er geen zijn wordt een boodschap weergegeven
        $template = LoadTemplate("eve_uwevenementen");
        if (!empty($data)) {
            $content = ReplaceContent($data, $template);
        } else {
            $content = "<h2 class='geen_eve maintitle'> U heeft geen evenementen. </h2>";
        };
        $data = array("content" => $content);
        $template = LoadTemplate("undertitle");
        print ReplaceContentRow($data, $template);

        //Formulier om evenement aan te maken
        include LoadTemplate("eve_aanmaken");

        //Als een van de beheerders is aangemeld wordt de button om gepasseerde evenementen te verwijderen, weergegeven
        if ($_SESSION['user']["use_email"] == 'nathanz@nathan.be' or $_SESSION['user']["use_email"] == 'roel.van.bilzen@gmail.com') {
            print LoadTemplate("verwijder_gepasseerd");
        }

    }
print LoadTemplate("scroll_to_top");
print LoadTemplate("basic_footer");
?>
