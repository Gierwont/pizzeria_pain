<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pizzeria";


$conn = new mysqli($servername, $username, $password,$dbname);

if ($conn->connect_error) {
    die("Nie połączono, błąd: " . $conn->connect_error);
}
?>