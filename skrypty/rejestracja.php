<?php

$tytul = "Rejestracja";
$baner = '<div id="baner"></br>Rejestracja</div><br />';
$zawartosc = "<div id=\"logowanie\"><form method=\"post\">
                Podaj login: <br /> <input type=\"text\" id=\"login1\" name=\"login1\"/><br />
                Podaj hasło: <br /> <input type=\"password\" id=\"haslo1\" name=\"haslo1\"/><br />
                Powtórz hasło: <br /> <input type=\"password\" id=\"haslo2\" name=\"haslo2\"/><br />
                <input type=\"submit\" id=\"rejestruj2\" value=\"Zarejestruj się\"></form></div>";

$polaczenie = @new mysqli("localhost", "root", "", "logowanie");

if($polaczenie -> connect_errno!=0)
{   echo "Error: ".$polaczenie->connect_errno;  }
else
{
    if(isset($_POST['login1']))
    {
        $wszystko_OK=true;
    
        $login1 = $_POST['login1'];
        //-------------------------------Walidacja----------------------------
        if(filter_var($login1, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^[a-zA-Z0-9_]{3,25}/')))==false)
        {
            $wszystko_OK=false;
            $_SESSION['e_login1'] = "<div id=\"blad1\">"."<span style=\"color:red\">Login musi posiadać od 3 do 25 znaków i składać się wyłącznie z liter i/lub cyfr (bez polskich znaków)"."</div>";
        }
    
        $haslo1 = $_POST['haslo1'];
        $haslo2 = $_POST['haslo2'];
    
        if(filter_var($haslo1, FILTER_VALIDATE_REGEXP, array('options' => array('regexp' => '/^[a-zA-Z0-9_]{3,25}/')))==false)
        {   
            $wszystko_OK=false;
            $_SESSION['e_haslo1'] = "<div id=\"blad1\">"."<span style=\"color:red\">Haslo musi posiadać od 3 do 25 znaków i składać się wyłącznie z liter i/lub cyfr (bez polskich znaków)"."</div>";
        }
    
        if($haslo1!=$haslo2)
        {
            $wszystko_OK=false;
            $_SESSION['e_haslo1'] = "<div id=\"blad1\"><span style=\"color:red\">Hasła są różne!</div>";
        }

        $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT);
    
        $rezultat = $polaczenie->query("SELECT id from logowanie where login='$login1'");
        $ile_takich_loginow = $rezultat->num_rows;
        if($ile_takich_loginow>0)
        {
            $wszystko_OK=false;
            $_SESSION['e_login1']="<div id=\"blad1\">"."<span style=\"color:red\">Istnieje już taki login.";
        }

        if($wszystko_OK==true)
        {
            if($polaczenie->query("INSERT into logowanie VALUES (NULL, '$login1', '$haslo_hash')"))
            {
                $_SESSION['udanarejestracja']=true;
                header("Location: index.php?strona=hello");
            }
        }
        
        $polaczenie->close();
    }
}
    
if(isset($_SESSION['e_login1']))
{   
    $zawartosc .= $_SESSION['e_login1']."<br/>";
    unset($_SESSION['e_login1']);
}

if(isset($_SESSION['e_haslo1']))
{   
    $zawartosc .= $_SESSION['e_haslo1']."<br/>";
    unset($_SESSION['e_haslo1']);
}