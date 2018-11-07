<?php

if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']=="true"))
{   header("Location: index.php?strona=zalogowany");
    exit(); }

$tytul = "Zaloguj się";
$baner = '<div id="baner"></br>Logowanie</div><br />';
$zawartosc = "<div id=\"logowanie\"><form action=\"skrypty/zaloguj.php\" method=\"post\">
                Login: <br /> <input type=\"text\" id=\"login\" name=\"login\"/><br />
                Hasło: <br /> <input type=\"password\" id=\"haslo\" name=\"haslo\"/><br />";

if(isset($_SESSION['blad']))
{   $zawartosc .= "<div id=\"blad\">".$_SESSION['blad']."</div>";   }

$zawartosc .= "<input type=\"submit\" id=\"zaloguj\" value=\"Zaloguj się\"/></form>";
$zawartosc .= "<input type=\"button\" id=\"rejestruj\" value=\"Zarejestruj się\" onClick= \"document.location.href='index.php?strona=rejestracja'\"></div>";

?>

