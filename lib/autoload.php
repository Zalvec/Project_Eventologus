<?php
// Dingen die op elke pagina moeten voorkomen
require_once "pdo.php";                         //database functies
require_once "view_functions.php";      //basic_head, load_template, replacecontent...
require_once "show_message.php";
require_once "authorisation.php";
session_start();
ShowMessages();
BasicHead();
PrintNavBar();
//var_dump($_SESSION['usr']);