<?php
/* Deze functie laadt de <head> sectie */
function BasicHead()
{
    print LoadTemplate("basic_head");
}

/* Functie om da navigatiebar te printen, deze is verschillend voor ingelogde gebruikers */
function PrintNavBar(){
    $laatstedeelURL = basename($_SERVER['SCRIPT_NAME']);
    if (!isset($_SESSION["user"])){
        $sql = "SELECT * from navigatie where nav_item <> 'Logout' and nav_item <> 'Beheer'";
        $data = GetData($sql);
        foreach( $data as $r => $row )
        {
            $data[$r]['nav_item'] = utf8_encode($data[$r]['nav_item']);
            if ( $laatstedeelURL == $data[$r]['nav_dest'] )
            {
                $data[$r]['active'] = 'active';
                $data[$r]['sr_only'] = '<span class="sr-only">(current)</span>';
            }
            else
            {
                $data[$r]['active'] = '';
                $data[$r]['sr_only'] = '';
            }
        }

        $template_navbar_item = LoadTemplate("nav_item");
        $navbar_items = ReplaceContent($data, $template_navbar_item);

        $data = array( "navbar_items" => $navbar_items ) ;
        $template_navbar = LoadTemplate("basic_header");
        print ReplaceContentRow($data, $template_navbar);

    } else{
        $sql = "SELECT * from navigatie where nav_item <> 'Login'";
        $data = GetData($sql);
        foreach( $data as $r => $row )
        {
            $data[$r]['nav_item'] = utf8_encode($data[$r]['nav_item']);
            if ( $laatstedeelURL == $data[$r]['nav_dest'] )
            {
                $data[$r]['active'] = 'active';
                $data[$r]['sr_only'] = '<span class="sr-only">(current)</span>';
            }
            else
            {
                $data[$r]['active'] = '';
                $data[$r]['sr_only'] = '';
            }
        }

        $template_navbar_item = LoadTemplate("nav_item");
        $navbar_items = ReplaceContent($data, $template_navbar_item);

        $data = array( "navbar_items" => $navbar_items ) ;
        $template_navbar = LoadTemplate("basic_header");
        print ReplaceContentRow($data, $template_navbar);
    }
}


/* Deze functie laadt de opgegeven template */
function LoadTemplate( $name )
{
    if (file_exists("templates/$name.html")) {
        return file_get_contents("templates/$name.html");
    }
     if (file_exists("../templates/$name.html")) {
        return file_get_contents("templates/$name.html");
    } else {
        return ("templates/$name.php");
    }
}

/* Deze functie voegt data en template samen en print het resultaat */
function ReplaceContent( $data, $template_html )
{
    $returnval = "";
    foreach ( $data as $row )
    {
        //replace fields with values in template
        $content = $template_html;
        foreach($row as $field => $value)
        {
            $content = str_replace("@@$field@@", $value, $content);
        }
        $returnval .= $content;
    }
    return $returnval;
}

/* Deze functie voegt data en template samen en print het resultaat */
function ReplaceContentRow( $row, $template_html )
{
        //replace fields with values in template
        $content = $template_html;
        foreach($row as $field => $value)
        {
            $content = str_replace("@@$field@@", $value, $content);
        }

        return $content;
}

/* Functie om replace content uit te voeren voor twee templates die bij elkaar horen */

function ReplaceALLContent($tempItems, $tempAll, $data){

    $template = LoadTemplate($tempItems);
    $content =  ReplaceContent($data, $template);
    $data = array("content" => $content);

    $template =  LoadTemplate("$tempAll");
    return ReplaceContentRow($data, $template);
}