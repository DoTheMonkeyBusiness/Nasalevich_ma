<?php
// Автозагрузка класса
function __autoload($class)
{
// Подключение файла с именем "class_имя_класса.php"
    include("classes"."\\" ."class_". $class . ".php");
}
$page = new hat_foot;
$page->hat();
$family_name = htmlspecialchars($_POST['fname']);
$name = htmlspecialchars($_POST['name']);
$second_name = htmlspecialchars($_POST['sname']);
$address = htmlspecialchars($_POST['ad']);
$passport = htmlspecialchars($_POST['pas']);
$quantity = intval(htmlspecialchars($_POST['many']));
$tour_id = htmlspecialchars($_POST['tour_id']);
$tur = new tour();
$price = doubleval($tur->find_price($tour_id));
$client = new customer;
@$nomer_clienta = $client->find_client($family_name, $passport);
$zakaz = new order();
if (isset($nomer_clienta))
{
    $zakaz->write_order($nomer_clienta, $tour_id, $quantity);
}
else
{
    @$nomer_clienta = $client->insert_client($name, $family_name,
        $second_name, $address, $passport);
    $zakaz->write_order($nomer_clienta, $tour_id, $quantity);
}
$page->footer();
?>