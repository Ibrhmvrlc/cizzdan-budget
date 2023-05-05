<?php
require_once("baglan.php");

unset($_SESSION["Kullanici"]);
session_destroy();

header("Location:girissayfasi.php");
exit();

$database = null;
?>
