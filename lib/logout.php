<?php
session_start();

//Session stoppen en unsetten
session_destroy();
unset($_SESSION);

session_start();
//Nieuwe session ID genereren
session_regenerate_id();
$_SESSION['msg'] = 'U bent uitgelogd!';
header("Location: ../index.php");
?>