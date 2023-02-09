<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <form action="register.php" method="POST">
        <div class="text">Podaj login:</div> <input type="text" name="login"><br>
        <div class="text">Podaj hasło:</div> <input type="password" name="pass"><br>
        <div class="text">Podaj email:</div> <input type="text" name="email"><br>
        <button type="submit" value="submit">zarejestruj się</button>
    </form><br><br><br>

    <form action="login.php" method="POST">
        <div class="text">Podaj login:</div> <input type="text" name="login"><br>
        <div class="text">Podaj hasło:</div> <input type="password" name="pass"><br>
        <button type="submit" value="submit">zaloguj się</button>
    </form>
    </div>
</body>
</html>