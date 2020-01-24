<?php

    require_once "lib/autoload.php";
    print LoadTemplate('zoeken');

    // Titel printen
    print "<h2 class=\"maintitle\">Uitgelicht</h2>";

    // SQL om 3 random evenementen uit de databank te halen
    $sql = "select *, date_format(eve_begindatum, \"%e %b %Y\") begin_format, date_format(eve_einddatum, \"%e %b %Y\") eind_format from evenement
        inner join locatie l on evenement.eve_loc_id = l.loc_id
        inner join postcode p on l.loc_pos_id = p.pos_id
        inner join categorie_evenement ce on evenement.eve_id = ce.cev_eve_id
        inner join categorie c on ce.cev_cat_id = c.cat_id
        order by RAND()
        limit 3";
    $data = GetData($sql);
    foreach ($data as $row => $value) {
        if ($value['eve_minprijs'] == 0) {
            $data[$row]['prijs'] = "Gratis";
        } else {
            $data[$row]['prijs'] = "Tickets vanaf: €".$data[$row]['eve_minprijs'];
        }
    }
    //Vervang velden in template 'uitgelicht' door resultaten query, vervang dan velden in undertitle door content van uitgelicht
    print ReplaceALLContent("uitgelicht", "undertitle", $data);

    print LoadTemplate('window');

    print "<h2 class=\"maintitle\">Categorieën</h2>";

    //Een array met de 2 categorieën in die op de homepagina worden weergegeven. Kan gemakkelijk aangepast worden naar andere categorieën
    $categorie = ["Conventies", "Festivals"];
    foreach ($categorie as $value) {
        //Haal met query de naam van de categorie uit db, en replace content uit temp 'titel' met de cat_naam
        $data1 = GetData("select cat_naam, cat_id from evenement
                                inner join locatie l on evenement.eve_loc_id = l.loc_id
                                inner join postcode p on l.loc_pos_id = p.pos_id
                                inner join categorie_evenement ce on evenement.eve_id = ce.cev_eve_id
                                inner join categorie c on ce.cev_cat_id = c.cat_id
                                where cat_naam = '" . $value ."'
                                order by cat_naam
                                limit 1");
        $cat_naam = $data1[0]['cat_naam'];
        $template = LoadTemplate("titel");
        print ReplaceContent($data1,$template);

        //Replace content met 3 evenementen van de categorie
        $template = LoadTemplate("categorie");
        $sql = "select *, date_format(eve_begindatum, \"%e %b %Y\") begin_format, date_format(eve_einddatum, \"%e %b %Y\") eind_format from evenement
                inner join locatie l on evenement.eve_loc_id = l.loc_id
                inner join postcode p on l.loc_pos_id = p.pos_id
                inner join categorie_evenement ce on evenement.eve_id = ce.cev_eve_id
                inner join categorie c on ce.cev_cat_id = c.cat_id
                where cat_naam = '".$cat_naam."' 
                order by eve_begindatum
                limit 3";
        $data = GetData($sql);

        //Geeft 'gratis' weer als de eve_minprijs 0 is, anders krijg je een tekst met de eve_minprijs in
        foreach ($data as $row => $value) {
            if ($value['eve_minprijs'] == 0) {
                $data[$row]['prijs'] = "Gratis";
            } else {
                $data[$row]['prijs'] = "Tickets vanaf: €".$data[$row]['eve_minprijs'];
            }
        }
        print ReplaceALLContent("categorie", "undertitle", $data);
    }
    print LoadTemplate("scroll_to_top");
    print LoadTemplate("basic_footer");

?>
