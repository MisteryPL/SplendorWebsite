<?php

if(!isset($_SESSION['udanarejestracja']))
{   header("Location: index.php?strona=logowanie");
    exit(); }

$tytul = "Gratulacje";
$baner = '<div id="baner"></br>Witaj nowy użytkowniku!</div><br />';
$zawartosc = "<div id=\"zarejestrowany\">Udana rejestracja! <br/><input type=\"button\" id=\"go_nowy\" value=\"Zaloguj się!\" onClick= \"document.location.href='index.php?strona=logowanie'\"></div>";

?>