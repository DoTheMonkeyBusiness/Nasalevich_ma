<?php
/**
 * Created by PhpStorm.
 * User: ХХХ
 * Date: 16.04.2018
 * Time: 12:28
 */

class order extends baza
{
    function write_order($customer_id, $tour_id, $quantity)
    {
        $segodnya = date("Y-m-d");
        $query = "SELECT price from tours where id=$tour_id";
        if ($result = $this->connection->query($query))
        {
            while ($row = $result->fetch_assoc())
            {
                $price = $row['price'];
                $summa = $quantity*$price;
            }
        }
        $query = "INSERT INTO orders (order_date, customer, amount)
VALUES('$segodnya',$customer_id, $summa)";
        if ($result = $this->connection->query($query))
        {
            echo "<br />Спасибо, ваш заказ принят.";
        }
        $query = "select LAST_INSERT_ID() as order_id";
        if ($result = $this->connection->query($query))
        {
            while ($row = $result->fetch_assoc())
            {
                $order_id = $row['order_id'];
            }
        }
        $query = "INSERT INTO order_items (order_id, tour_id, quantity) ".
            "VALUES ($order_id, $tour_id, $quantity)";
        if ($result = $this->connection->query($query))
        {
            echo "<p>Запись в order_items сделана.";
        }
    }
    function show_orders()
    {
        @$start = $_GET['start'];
        if(!$start) $start = 0; // Начальная строка выборки из базы
        $number = 10; // Количество записей на странице
        $query = "SELECT count(id) as row_cnt FROM order_items";
        if ($result = $this->connection->query($query))
        {
            $row = mysqli_fetch_assoc($result);
            $row_cnt = $row['row_cnt'];
            $chislo_stranits = (int)($row_cnt/$number+1);
        }
        $stop = $start+$number;
        $query = "SELECT o.order_date, c.family_name, o.quantity ".
            "FROM customers as c, orders as o, order_items as oi ".
            "WHERE c.id=o.customer ".
            "AND o.id=oi.order_id ".
            "LIMIT $start,$stop ";
        $HrefPage = '';
        if ($result = $this->connection->query($query))
        {
            echo "<p>Список клиентов</p>";
            echo "<table border=1 cellspacing=0 cellpadding=1>";
            echo "<tr><th>Дата заказа</th> <th>Фамилия</th>".
                "<th>Сумма заказа</th> </tr>";
            $i = 0;
            while($i<$number)
            {
                if($row = mysqli_fetch_assoc($result))
                {
                    echo "<tr> <td>".$row['order_date']."</td> <td>".
                        $row['family_name']."</td><td>".$row['quantity'].
                        "</td></tr>";
                }
                $i++;
            }
            echo "</table>";
            $tekush_stranitsa = $start/$number +1;
            echo "Номер страницы :".$tekush_stranitsa."<br>Страницы :";
            for ($link = 1; $link <= $chislo_stranits; $link++)
            {
                $PageStart = ($link - 1) * $number;
                $HrefPage = "<a href = ".$_SERVER['SCRIPT_NAME'].
                    "?format=orders&start=".$PageStart.
                    " target=_parent> ".$link."</a>";
                echo " ".$HrefPage;
            }
        }
    }
}
?>