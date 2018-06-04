<?php
// Автозагрузка класса
function __autoload($class)
{
// Подключение файла с именем "class_имя_класса.php"
    include("classes"."\\"."class_".$class . ".php");
}
$page = new hat_foot;
$page->hat();
$city = $_GET['name'];
$country = $_GET['strana'];
echo "Страна :".$country." Город: ".$city."<br/>";
$gorod = new city($city);
echo $gorod->show_description($country);
$page->footer();

?>