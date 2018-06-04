<?php
session_start();
$city = $_GET['format2'];
$country = $_SESSION['strana'];
$_SESSION['strana'] = $country;
$_SESSION['gorod'] = $city;
function __autoload($class)
{
// Подключение файла с именем "class_имя_класса.php"
    include("classes"."\\"."class_".$class . ".php");
}
$page = new hat_foot;
$page->hat();
echo "<a href = 'display_country.php?name=" . $country . "'>" .
    $country . "</a> ";
echo "<a href = 'display_city.php?name=" . $city .
    "&strana=".$country."'>" . $city."</a>";
$tur = new tour();
$tur->display($country, $city);
$page->footer();
?>