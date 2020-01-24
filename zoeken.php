<?php
    require_once 'lib/autoload.php';
    print LoadTemplate('zoeken');

    $trefwoord = $_POST['trefwoord'];

    //Alle evenementen ophalen waar de naam, gebouw, of gemeente voldoet aan de zoekopdracht
    $sql = "select *, date_format(eve_begindatum, \"%e %b %Y\") begin_format, date_format(eve_einddatum, \"%e %b %Y\") eind_format  from evenement
                                inner join locatie l on evenement.eve_loc_id = l.loc_id
                                inner join postcode p on l.loc_pos_id = p.pos_id
                                inner join categorie_evenement ce on evenement.eve_id = ce.cev_eve_id
                                inner join categorie c on ce.cev_cat_id = c.cat_id 
                                where eve_naam like '%".$trefwoord."%' 
                                or loc_gebouw like '%".$trefwoord."%' 
                                or pos_gemeente like '%".$trefwoord."%'
                                order by eve_begindatum";
    $data = GetData($sql);
    $template = LoadTemplate('categorie');

    //Als er geen evenementen zijn, melding weergeven
    if (empty($data)){
        print "<h2 class='geen_zoek'> Er zijn geen evenementen die aan deze zoekopdracht voldoen. </h2>";
        //Als er niets wordt ingegeven, melding weergeven
    } if ($trefwoord == ""){
        print "<h2 class='geen_zoek'> Geef een zoekopdracht in. </h2>";
    } else {
        //Alle evenementen die aan de zoekopdracht voldoen tonen

        //Geeft 'gratis' weer als de eve_minprijs 0 is, anders krijg je een tekst met de eve_minprijs in
        foreach ($data as $row => $value) {
            if ($value['eve_minprijs'] == 0) {
                $data[$row]['prijs'] = "Gratis";
            } else {
                $data[$row]['prijs'] = "Tickets vanaf: €" . $data[$row]['eve_minprijs'];
            }
        }
        print ReplaceALLContent("categorie", "undertitle", $data);
    }

    print LoadTemplate("basic_footer");
?>