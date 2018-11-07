<?php

session_start();

if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
    header("Location: index.php?strona=logowanie");
    exit();
}

$polaczenie = @new mysqli("localhost", "root", "", "logowanie");

if($polaczenie -> connect_errno!=0)
{
    echo "Error: ".$polaczenie->connect_errno;
}
else
{
    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8"); //sanityzacja (Ochrona #1) - zamiana znaków na htmlentities

    if($rezultat = @$polaczenie->query(sprintf("SELECT * FROM logowanie where login='%s'",mysqli_real_escape_string($polaczenie, $login)))) //Ochrona  - wstrzykiwanie            
    {
        $ilu_userow = $rezultat->num_rows;
        if($ilu_userow >0)
        {   $wiersz = $rezultat->fetch_assoc();
            
            if(password_verify($haslo, $wiersz['haslo']))
            {
                $_SESSION['zalogowany'] = "true";
                $_SESSION['user'] = $wiersz['login'];
                unset($_SESSION['blad']);
                $rezultat->close();
                header("Location: ../index.php?strona=zalogowany");
            }
            else
            {
                $_SESSION['blad'] = '<span style="color:red">Nieprawidłowe hasło!</span>';
                header("Location: ../index.php?strona=logowanie");
            }
        }
        else
        {
            $_SESSION['blad'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
            header("Location: ../index.php?strona=logowanie");
        }
    }

    $polaczenie -> close();
}
?>