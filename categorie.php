<?php

    require_once "lib/autoload.php";

    //Navigatie categorieën printen
    $sql = "select * from categorie
                left join categorie_evenement ce on categorie.cat_id = ce.cev_cat_id
                group by cat_naam
                order by cat_id";
    $data = GetData($sql);
    print ReplaceALLContent("catnav_item", "catnav", $data );
    print LoadTemplate('zoeken');

    //Als GET leeg is wordt er geen specifieke categorie aangeroepen, als dat wel zo is moet er een where statement bij de SQL komen
    if (empty($_GET)){
        $where = "";
    } else {
        foreach ($_GET as $id => $niks){
        }
        $where = "where cev_cat_id = ".$id;
    }

    //Als $where leeg is, is er geen specifieke categoriepagina geladen, dus kunnen alle evenementen geladen worden
    if (empty($where)){
        ?>
        <div class="titel">
        <a href="categorie.php"><h2>Alle</h2></a>
        </div>
<?php
    //Anders worden enkel de evenementen van deze categorie geladen
    } else {
        $data = GetData("select * from categorie 
                            inner join categorie_evenement ce on categorie.cat_id = ce.cev_cat_id ".$where." limit 1");
        $templateTitel = LoadTemplate('titel');
        print ReplaceContent($data,$templateTitel);
    }

    //Alle evenementen laden van een specifieke categorie, gesorteerd op begindatum
    $sql = "select *, date_format(eve_begindatum, \"%e %b %Y\") begin_format, date_format(eve_einddatum, \"%e %b %Y\") eind_format  from evenement
                            inner join locatie l on evenement.eve_loc_id = l.loc_id
                            inner join postcode p on l.loc_pos_id = p.pos_id
                            inner join categorie_evenement ce on evenement.eve_id = ce.cev_eve_id
                            inner join categorie c on ce.cev_cat_id = c.cat_id ".$where.
                            " order by eve_begindatum";
    $data = GetData($sql);

    //Geeft 'gratis' weer als de eve_minprijs 0 is, anders krijg je een tekst met de minimumprijs in
    foreach ($data as $row => $value) {
        if ($value['eve_minprijs'] == 0) {
            $data[$row]['prijs'] = "Gratis";
        } else {
            $data[$row]['prijs'] = "Tickets vanaf: €".$data[$row]['eve_minprijs'];
        }
    }
    //Alle data wordt vervangen in de categorie.html ingevuld en daarna wordt deze data vervangen in de undertitle.html
    print ReplaceALLContent("categorie", "undertitle", $data);

    print LoadTemplate("scroll_to_top");
    print LoadTemplate("basic_footer");

?>