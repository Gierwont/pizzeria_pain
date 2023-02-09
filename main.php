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
        $current_login=$_SESSION["login"];
        echo $current_login;
        $result = mysqli_query($conn, "SELECT * FROM pizza ");
        echo '<table><tr><th>Numer</th><th>Nazwa</th><th>Skladniki</th><th>Cena</th></tr>';
        while($row = mysqli_fetch_array($result)) {
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
    if(isset($_POST['submit'])){  //skladanie zamowienia
        echo $current_login;
   
    $numer= $_POST['numer'];
    $city= $_POST['city'];
    $street= $_POST['street'];

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
    


    if(isset($_POST['button'])){ //wypisywanie historii zamowien

        if($current_login=="admin"){
            $result = mysqli_query($conn, "SELECT * FROM pizza_order ");
            echo '<table><tr><th>Numer zamowienia</th><th>Numer pizzy</th><th>Miasto</th><th>Ulica</th><th>Czy wysłano</th><th>Wyślij</th></tr>';
            while($row = mysqli_fetch_array($result)) {
                echo "<tr><td>{$row['id']}</td><td>{$row['numer']}</td><td>{$row['city']}</td><td>{$row['street']}</td><td>{$row['is_sent']}</td></tr>";
            }
            echo '</table>'; 
        }
        else {
            $result = mysqli_query($conn, "SELECT * FROM pizza_order WHERE ordered_by ='$current_login' ");
            echo '<table><tr><th>Numer zamowienia</th><th>Numer pizzy</th><th>Miasto</th><th>Ulica</th><th>Czy wysłano</th></tr>';
            while($row = mysqli_fetch_array($result)) {
                echo "<tr><td>{$row['id']}</td><td>{$row['numer']}</td><td>{$row['city']}</td><td>{$row['street']}</td><td>{$row['is_sent']}</td></tr>";
            }
            echo '</table>'; 
        }
        
    }



    mysqli_close($conn);
    ?>
    <br><br>
    <a href="logout.php">Wyloguj</a>
</body>
</html>