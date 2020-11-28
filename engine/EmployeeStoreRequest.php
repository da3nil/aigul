<?php

require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    return false;
}

if (!isset($_POST["firstName"])) {$_POST["firstName"] = "Неизвестно";}

if (!isset($_POST["lastName"])) {$_POST["lastName"] = "Неизвестно";}

if (!isset($_POST["middleName"])) {$_POST["middleName"] = "Неизвестно";}

if (!isset($_POST["email"])) {$_POST["email"] = "Неизвестно";}

if (!isset($_POST["family"])) {$_POST["family"] = "Неизвестно";}

if (!isset($_POST["pass"])) {$_POST["pass"] = "Неизвестно";}

if (!isset($_POST["phone"])) {$_POST["phone"] = "Неизвестно";}

if (!isset($_POST["education"])) {$_POST["education"] = "Неизвестно";}

if (!isset($_POST["position"])) {$_POST["position"] = "Неизвестно";}

$data = [
    "firstName" => $_POST["firstName"],
    "lastName" => $_POST["lastName"],
    "middleName" => $_POST["middleName"],
    "email" => $_POST["email"],
    "family" => $_POST["family"],
    "pass" => $_POST["pass"],
    "phone" => $_POST["phone"],
    "education" => $_POST["education"],
    "position" => $_POST["position"],
];

$link = mysqli_connect('localhost', DB_user, DB_pass, DB_name);

mysqli_set_charset($link, "utf8");

$query = "
INSERT INTO employees(" . implode(array_keys($data), ',') .")
VALUES(". "'" . implode("','", $data) . "'" .");";

$result = mysqli_query($link, $query);

mysqli_close($link);

if ($result) {
    header("Location: ../index.php");
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    die("Неизвестная ошибка");
}

?>

