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
    

    $login= $_POST['login'];
    $_SESSION["login"] = $login;
    $pass = szyfruj_cezara(sha1($_POST['pass']),3);


    $result = mysqli_fetch_array(mysqli_query($conn,"SELECT COUNT(*) FROM `user` WHERE `login` = '$login' AND `haslo` = '$pass'")); 
    if ($result[0] == 0) {
        echo '<div class="text">niepoprawne hasło lub login</div>';

    } else {
        header("Location: /main.php");
    }
     mysqli_close($conn);
    ?>
</body>
</html>