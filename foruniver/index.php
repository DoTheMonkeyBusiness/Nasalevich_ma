<?php
/**
 * Created by PhpStorm.
 * User: ХХХ
 * Date: 16.04.2018
 * Time: 12:32
 */

mysql_set_charset('utf8');

// Открытие сессии
session_start();
@$strana = $_GET['format'];
// Автозагрузка класса
function __autoload($class)
{
// Подключение файла с именем "class_имя_класса.php"
    include("classes"."\\"."class_".$class . ".php");
}
$db = new baza();
$spisok = $db->show_country_list();
$page = new hat_foot;
$page->hat();
echo "our offers :<br />";
echo "<table border=0>";
for ($i = 0; $i < count($spisok); $i++)
{
    echo '<tr><td bgcolor="#CCFF99">';
    echo $spisok[$i]."<br>";
    echo'</td><td bgcolor="#CCFF99">';
    $starna = new country($spisok[$i]);
    echo "с ".$starna->min_off()."<br>";
    echo "</td></tr>";
}
echo "<table border=0><tr><td colspan=2>".
    "Для просмотра предложений выберите страну и город</td></tr>".
    "<tr> <td>";
// Создание формы для выбора страны с передачей данных в этот же скрипт
echo '<form><select name="format" size="1">';
for ($i = 0; $i < count($spisok); $i++)
{
// Создание элемента формы для вывода списка стран
    if ($spisok[$i] == $strana )
    {
        echo '<option selected "value="'.$spisok[$i].'">'. $spisok[$i];
    }
    else
    {
        echo '<option "value="'.$spisok[$i].'">'. $spisok[$i];
    }
}
echo '</select><input type="submit" value="OK"></form>';
echo "</td><td>";
// Получение имени страны из вышеописанной формы
@$country = $_GET['format'];
// Регистрация переменной сессии - country
$_SESSION['strana'] = $country;
// Если страна выбрана, печатаем список городов в данной стране
if ($country != '')
{
    echo '<form action="select_tour.php"><select name="format2" size="1">';
// Создание элемента формы для вывода списка городов
    $starna = new country($country);
    $goroda = $starna->show_city_list();
    for ($i = 0; $i < count($goroda); $i++)
    {
        echo '<option value="'.$goroda[$i].'">'. $goroda[$i];
    }
    echo '</select><input type="submit" value="OK"></form>';
}
echo "</td></tr></table>";
$page->footer();
?>