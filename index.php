<?php
require_once("klasy/Strona.php");
session_start();
$strona_akt = new Strona();

if(isset($_GET['strona']))
{
	$strona = $_GET['strona'];
	switch($strona)
	{
		case 'index': $strona = 'glowna'; break;
		case 'logowanie': $strona = 'logowanie'; break;
                case 'zalogowany': $strona = 'zalogowany'; break;
                case 'wylogowanie': $strona = 'wylogowanie'; break;
                case 'rejestracja': $strona = 'rejestracja'; break;
                case 'hello': $strona = 'hello'; break;
                case 'ranking': $strona = 'ranking'; break;
                case 'zasady': $strona = 'zasady'; break;
		default: $strona = 'glowna';
	}
}

else
{
	$strona = "glowna";
}

$plik = "skrypty/" . $strona . ".php";

if(file_exists($plik))
{
	require_once($plik);
	$strona_akt->ustaw_style('CSS/style.css');	
	$strona_akt->ustaw_tytul($tytul);
        $strona_akt->ustaw_baner($baner);
	$strona_akt->ustaw_zawartosc($zawartosc);
	$strona_akt->wyswietl();
}
?>