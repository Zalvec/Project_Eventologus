<div class="social">
<?php

foreach ($_GET as $id => $niks){
};

$sql = "select som_name, som_icoon, hyp_link from hyperlink
                    inner join socialmedia s on hyperlink.hyp_som_id = s.som_id
                    inner join evenement e on hyperlink.hyp_eve_id = e.eve_id
                    where eve_id = $id";
$data = GetData($sql);

$sql_som = "select som_name from socialmedia";
$som = GetData($sql_som);
$som_name = array();
foreach ($som as $niks=>$array){
    $som_name[]= $array['som_name'];
}
foreach ($data as $row) {
    if (in_array($row['som_name'], $som_name)) {
        $icoon = $row['som_icoon'];
        if (substr( $row['hyp_link'], 0, 7 ) === "http://" or substr( $row['hyp_link'], 0, 8 ) === "https://" ){
            $link = $row['hyp_link'];
        } else{
            $link = 'https://'.$row['hyp_link'];
        }
        print "<a href='".$link."' class='".$icoon."' target=\"_blank\"></a>";
    }
}
?>
</div>
