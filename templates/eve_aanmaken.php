<h2 class="maintitle" id="evenement_aanmaken">Evenement aanmaken</h2>

<section class="contcontainer beheer">

    <section class="wijzig">
        <form action="lib/aanmaken.php" method="post" id="eve_aanmaken" enctype="multipart/form-data" class="aanmaakform">

            <input type="hidden" id="formname" name="formname" value="eve_form">
            <input type="hidden" id="tablename" name="tablename" value="evenement">
            <input type="hidden" id="pkey" name="pkey" value="eve_id">

            <div class="invul">
                <label for="eve_naam">Naam</label>
                <input type="text" name="eve_naam" id="eve_naam" placeholder="Naam..." required oninvalid="this.setCustomValidity('Gelieve een naam voor het evenement in te geven')" oninput="setCustomValidity('')">
            </div>
            <div class="invul">
                <fieldset>
                    <legend>Locatie</legend>
                    <label for="loc_straat" hidden>Straat</label>
                    <input id="loc_straat" placeholder="Straat..." name="loc_straat">
                    <label for="loc_nr" hidden>Nummer</label>
                    <input id="loc_nr" placeholder="Huisnr..." name="loc_nr">
                    <select name="loc_pos_id" id='loc_pos_id' required oninvalid="this.setCustomValidity('Gelieve een postcode te selecteren')" oninput="setCustomValidity('')">
                        <?php
                        $sql = "select pos_id, pos_code, pos_gemeente from postcode order by pos_code";
                        $data_pos = GetData($sql);
                        ?>
                        <option value='' disabled selected>Selecteer de postcode..</option>
                        <?php
                        foreach ($data_pos as $array){
                            $option = "$array[pos_code], $array[pos_gemeente]";
                            echo "<option value='$array[pos_id]'>$option</option>";}
                        ?>
                    </select>
                    <label for="loc_gebouw" hidden>Gebouw</label>
                    <input id="loc_gebouw" placeholder="Gebouw..." name="loc_gebouw">
                </fieldset>
            </div>
            <div class="invul">
                <fieldset>
                    <legend>Prijs (zonder €-teken)</legend>
                    <div class="checkbox">
                        <input type="checkbox" name="check" id="check" value="Gratis" onclick="disableMyText()">
                        <label for="check">Gratis</label>
                    </div>
                    <label for="eve_minprijs" hidden>Min. prijs</label>
                    <input type="number" name="eve_minprijs" id="eve_minprijs" placeholder="Minimum..." required oninvalid="this.setCustomValidity('Gelieve de minimumprijs in te stellen of GRATIS aan te vinken. Gebruik hiervoor 0-9 , en .')" oninput="setCustomValidity('')">
                    <label for="eve_maxprijs" hidden>Max. prijs</label>
                    <input type="number" name="eve_maxprijs" id="eve_maxprijs" placeholder="Maximum..." required oninvalid="this.setCustomValidity('Gelieve de maximumprijs in te stellen. Gebruik hiervoor 0-9 , en .')" oninput="setCustomValidity('')">
                </fieldset>
            </div>
            <div class="invul">
                <fieldset>
                    <legend>Datum</legend>
                    <label for="eve_begindatum" hidden>Begindatum</label>
                    <input type="date" name="eve_begindatum" id="eve_begindatum" placeholder="Begindatum..." required oninvalid="this.setCustomValidity('Gelieve de begindatum in te stellen')" oninput="setCustomValidity('')">
                    <label for="eve_einddatum" hidden>Einddatum</label>
                    <input type="date" name="eve_einddatum" id="eve_einddatum" placeholder="Einddatum..." required oninvalid="this.setCustomValidity('Gelieve de einddatum in te stellen')" oninput="setCustomValidity('')">
                </fieldset>
            </div>
            <div class="invul">
                <fieldset>
                    <legend>Tijd</legend>
                    <label for="eve_opening" hidden>Beginuur</label>
                    <input type="time" name="eve_opening" id="eve_opening" placeholder="Beginuur..." required oninvalid="this.setCustomValidity('Gelieve het beginuur in te vullen')" oninput="setCustomValidity('')">
                    <label for="eve_sluiting" hidden>Einduur</label>
                    <input type="time" name="eve_sluiting" id="eve_sluiting" placeholder="Sluituur..." required oninvalid="this.setCustomValidity('Gelieve het einduur in te vullen')" oninput="setCustomValidity('')">
                </fieldset>
            </div>
            <div class="invul">
                <fieldset class="socialemedia">
                    <legend>Links</legend>
                    <div class="linksdiv">
                        <div>
                            <label for="Website">Website</label>
                            <input type="text" name="Website" id="Website" placeholder="www.website.com" >
                            <label for="Tickets">Ticket</label>
                            <input type="text" name="Tickets" id="Tickets" placeholder="www.ticket.com">
                            <label for="Facebook">Facebook</label>
                            <input type="text" name="Facebook" id="Facebook" placeholder="www.facebook.com">
                        </div>
                        <div>
                            <label for="Instagram">Instagram</label>
                            <input type="text" name="Instagram" id="Instagram" placeholder="www.instagram.com">
                            <label for="Twitter">Twitter</label>
                            <input type="text" name="Twitter" id="Twitter" placeholder="www.twitter.com">
                            <label for="Youtube">Youtube</label>
                            <input type="text" name="Youtube" id="Youtube" placeholder="www.youtube.com">
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="invul">
                <legend>Categorie</legend>
                <select name="cev_cat_id" id='cev_cat_id' required oninvalid="this.setCustomValidity('Gelieve de categorie te selecteren')" oninput="setCustomValidity('')">
                    <?php
                    $sql = "select * from categorie order by cat_id";
                    $data_cat = GetData($sql);
                    ?>
                    <option value='' disabled selected>Selecteer de categorie..</option>
                    <?php
                    foreach ($data_cat as $array){
                        $option = "$array[cat_naam]";
                        echo "<option value='$array[cat_id]'>$option</option>";}
                    ?>
                </select>
            </div>
            <div class="invul">
                <label for="eve_beschrijving">Beschrijving</label>
                <textarea name="eve_beschrijving" id="eve_beschrijving" required oninvalid="this.setCustomValidity('Gelieve je evenement van een beschrijving te voorzien')" oninput="setCustomValidity('')"></textarea>
            </div>

            <div class="invul">
                <label for="eve_image">Afbeelding</label>
                <img src="images/placeholder.png" onclick="triggerClick()" id="display">
                <input type="file" name="eve_image" onchange="displayImage(this)" id="eve_image">
            </div>

            <div class="check">
                <input type="checkbox" name="GDPR" id="GDPR" required oninvalid="this.setCustomValidity('Gelieve akkoord te gaan met de GDPR voorwaarden voor u het evement kan aanmaken')" oninput="setCustomValidity('')">
                <label for="GDPR">Ik ga akkoord met de <a href="GDPR.php" title="" target="_blank">GDPR voorwaarden</a></label>
            </div>
            <div class="check">
                <input type="checkbox" name="algemene_voorwaarden" id="algemene_voorwaarden" required oninvalid="this.setCustomValidity('Gelieve akkoord te gaan met onze algemene voorwaarden voor u het evement kan aanmaken')" oninput="setCustomValidity('')">
                <label for="algemene_voorwaarden">Ik ga akkoord met de <a href="algemene_voorwaarden.php" target="_blank" title="">algemene voorwaarden</a></label>
            </div>

            <div class="beheerbutton">
                <button type="submit" name="aanmaakbutton" value="Aanmaken">Evenement aanmaken</button>
            </div>
        </form>
    </section>
</section>

<script src="js/scripts.js"></script>