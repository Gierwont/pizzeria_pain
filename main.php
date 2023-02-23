<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    require('connect.php');
    $current_login = $_SESSION["login"];
    echo "Witaj ," . $current_login ;
    $result = mysqli_query($conn, "SELECT * FROM pizza ");
    echo '<table><tr><th>Numer</th><th>Nazwa</th><th>Skladniki</th><th>Cena</th></tr>';
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>{$row['id']}</td><td>{$row['nazwa']}</td><td>{$row['skladniki']}</td><td>{$row['cena']}</td></tr>";
    }
    echo '</table>';


    ?>
    <br><br>
    <form action="main.php" method="POST">
        Podaj numer pizzy która chcesz zamówić: <input type="number" name="numer" min="1" max="4"><br>
        Podaj miasto: <input type="text" name="city"><br>
        Podaj ulicę: <input type="text" name="street"><br>
        <input type="submit" name="submit" value="Kup pizze">
    </form>

    <?php
    if (isset($_POST['submit'])) { //skladanie zamowienia
    
        $numer = $_POST['numer'];
        $city = $_POST['city'];
        $street = $_POST['street'];

        $sql = "INSERT INTO pizza_order (numer,city,street,ordered_by,is_sent) VALUES ('$numer','$city','$street','$current_login','nie')";

        if (mysqli_query($conn, $sql)) {
            echo "<h1>Złożono zamówienie</h1>";
        }
    }

    ?>

    <br><br>

    <form action="main.php" method="POST">
        <input type="submit" name="button" value="Pokaż historię zamówień"><br>
    </form><br>

    <?php



    if (isset($_POST['button'])) { //wypisywanie historii zamowien
    
        if ($current_login == "admin") {
            $result = mysqli_query($conn, "SELECT * FROM pizza_order ");
            echo '<table><tr><th>Numer zamowienia</th><th>Numer pizzy</th><th>Miasto</th><th>Ulica</th><th>Czy wysłano</th><th>Wyślij</th></tr>';
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr><td>{$row['id']}</td><td>{$row['numer']}</td><td>{$row['city']}</td><td>{$row['street']}</td><td>{$row['is_sent']}</td></tr>";
            }
            echo '</table>';
        } else {
            $result = mysqli_query($conn, "SELECT * FROM pizza_order WHERE ordered_by ='$current_login' ");
            echo '<table><tr><th>Numer zamowienia</th><th>Numer pizzy</th><th>Miasto</th><th>Ulica</th><th>Czy wysłano</th></tr>';
            while ($row = mysqli_fetch_array($result)) {
                echo "<tr><td>{$row['id']}</td><td>{$row['numer']}</td><td>{$row['city']}</td><td>{$row['street']}</td><td>{$row['is_sent']}</td></tr>";
            }
            echo '</table>';
        }

    }

    ?>
    <br><br>
    <h1>Edycja danych konta</h1>
    <form action="main.php" method="POST">
        Podaj nowy login: <input type="text" name="new_login"><br>
        Podaj nowe hasło: <input type="text" name="new_pasword"><br>
        Podaj nowy email: <input type="text" name="new_email"><br>
        Podaj stare hasło: <input type="text" name="old_password"><br>
        <input type="submit" name="edit" value="Edytuj dane konta"><br>
        <h6>Po zmianie danych nastąpi wylogowanie</h6>
    </form><br>


    <?php
    if (isset($_POST['edit'])) {

        $new_login = $_POST["new_login"];
        $new_password = szyfruj_cezara(sha1($_POST['new_pasword']),3);
        $new_email = $_POST["new_email"];
        $old_password = szyfruj_cezara(sha1($_POST['old_password']),3);


        $sql = "SELECT haslo FROM user WHERE login = '$current_login'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $pass_indatabase = $row['haslo'];
            if (filter_var($new_email, FILTER_VALIDATE_EMAIL) && $pass_indatabase == $old_password) {


                $sql = "UPDATE user SET login = '$new_login', haslo= '$new_password', email= '$new_email' WHERE haslo='$old_password'";
                if (mysqli_query($conn, $sql)) {
                    echo "<div class='text'>Dodano rekord</div>";
                    header("Location: /logout.php");
                } else {
                    echo "błąd: " . $sql_edit . mysqli_error($conn);
                }
            } else {
                echo "podano niepoprawny email lub hasło się nie zgadza";
            }

        } else {
            echo 'Nie udało się pobrać rzeczy z bazy danych.';
        }
        
    }

    ?>


    <br><br>
    <a href="logout.php">Wyloguj</a>
</body>

</html>