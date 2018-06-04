<?php
// Автозагрузка класса

function __autoload($class)
{
// Подключение файла с именем "class_имя_класса.php"
    include("classes"."\\"."class_".$class . ".php");
}
$country = $_GET['name'];
$strana = new country($country);
echo $strana->show_description();
echo "<br/>Города: <br/>";
$spisok = $strana->show_city_list();
foreach ($spisok as $gorod)
{
    echo $gorod."<br/>";
}
?>