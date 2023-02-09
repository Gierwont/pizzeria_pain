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


    if($_POST['login']=="" || $_POST['pass']==""){
        echo  "<h1 class='text'>podałeś puste hasło lub login</h1>";
    }
    else{
    $login= $_POST['login'];
    $pass= sha1($_POST['pass']);
    $email= $_POST['email'];

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = "INSERT INTO user (login,haslo,email,admin) VALUES ('$login','$pass','$email',0)";

        if (mysqli_query($conn, $sql)) {
            echo "<h1>Dodano rekord</h1>";
        } 
    else {
        echo '<div class="text"><h1>błąd: ' . $sql  . mysqli_error($conn) .'</h1></div>';
    }
    } 
    else {
        echo("Podano niepoprawny adres email");
    }

    
}


    mysqli_close($conn);
    ?>
    <br><div class="text"><a href="index.php">Powrót</a></div> 
</body>
</html>