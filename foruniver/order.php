<?php
// Автозагрузка класса
function __autoload($class)
{
// Подключение файла с именем "class_имя_класса.php"
    include("classes"."\\" ."class_". $class . ".php");
}
$page = new hat_foot;
$page->hat();
$tour_id = $_GET['id'];
$tur = new tour();
$tur->info($tour_id);
?>
<form method="POST" action="process_order.php">
    <table>
        <tr>
            <td>Фамилия: </td>
            <td><input type="text" name="fname"></td>
        </tr><tr>
            <td>Имя: </td>
            <td><input type="text" name="name"></td>
        </tr><tr>
            <td>Отчество: </td>
            <td><input type="text" name="sname"></td>
        </tr><tr>
            <td>Адрес: </td>
            <td><input type="text" name="ad"></td>
        </tr><tr>
            <td>Паспортные данные: </td>
            <td><input type="text" name="pas"></td>
        </tr><tr>
            <td>Количество заказываемых туров: </td>
            <td><input type="text" name="many"></td>
        </tr><tr>
            </td>
        </tr>
    </table>
    <input type="hidden" name="tour_id" value="<?php echo $tour_id; ?>">
    <input type="submit" value="Заказать">
</form>
<?php
$page->footer();
?>
</body>
</html>