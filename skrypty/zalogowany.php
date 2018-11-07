<?php

if(!isset($_SESSION['zalogowany']))
{
    header("Location: index.php?strona=logowanie");
    exit();
}

$tytul = "Panel uzytkownika";
$baner = '<div id="baner"></br>Witaj '.$_SESSION['user'].'</div><br />';
$zawartosc = "
<div id=\"zalogowany\"><br /><br /><br />
Panel użytkownika<br /><br /><br />
<a href=\"index.php?strona=wylogowanie\">[ Wyloguj się ]</a></div>";

?>