<?php
// Автозагрузка класса
function __autoload($class)
{
// Подключение файла с именем "class_имя_класса.php"
    include("classes"."\\"."class_".$class . ".php");
}
$page = new hat_foot;
$page->hat();
$country = $_GET['strana'];
$city = $_GET['gorod'];
$hotel = $_GET['name'];
echo "Страна: ".$country." Город: ".$city."<br/>";
$gostinica = new hotel($hotel);
$gostinica->show_description($city,$country);
$page->footer();
?>