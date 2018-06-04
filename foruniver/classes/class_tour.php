<?php
/**
 * Created by PhpStorm.
 * User: ХХХ
 * Date: 16.04.2018
 * Time: 12:25
 */

class tour extends baza
{
    /*
    Вывод списка туров в выбранный город и страну
    */
    function display($country,$city)
    {
        $query = "SELECT h.id as h_id, h.name,
t.price, t.duration, t.startdate,t.id ".
            "FROM hotels as h, tours as t, cities as c ".
            "WHERE t.hotel=h.id ".
            "AND c.name=\"$city\" AND c.country=\"$country\" ".
            "AND c.id=h.city";
        echo "<table border=0 bgcolor='#CCFF99'>";
        echo "<tr><th>Отель</th> <th>Цена</th> <th>Дата</th>".
            "<th>Дни</th><th>&nbsp;</th></tr>";
        if ($result = $this->connection->query($query))
        {
            while ($row = $result->fetch_assoc())
            {
// Задание свойств объекта по результатам выборки из базы данных
                $this->name = $row['name'];
                $this->price = $row['price'];
                $this->duration = $row['duration'];
                $this->startdate = $row['startdate'];
                $this->id = $row['id'];
                echo "<td><a href='display_hotel.php?name=".
                    $this->name."&gorod=".$city."&strana=".$country."'>".
                    $this->name."</a></td>";
                echo "<td>".$this->price."</td>";
                echo "<td>".$this->startdate."</td>";
                echo "<td>".$this->duration."</td>";
                echo "<td> <a href='order.php?id=".$this->id.
                    "'>Заказать тур </a></td></tr>";
            }
        }
        $result->close();
        echo "</table>";
    }
    /*
    Вывод названия отеля и даты начала тура
    */
    function info($tour_id)
    {
        $query="SELECT t.startdate, h.name
FROM tours as t, hotels as h
WHERE t.id=$tour_id
AND t.hotel=h.id
AND t.id=\"$tour_id\"";
        if ($result = $this->connection->query($query))
        {
            while ($row = $result->fetch_assoc())
            {
                echo "<p>Отель: ". $row['name'].
                    " Дата начала тура: ".$row['startdate']."</p>";
            }
        }
    }
    /*
    Поиск стоимости тура по его номеру и типу команты
    */
    function find_price($tour_id)
    {
        $query = "SELECT price FROM tours WHERE id = $tour_id";
        if ($result = $this->connection->query($query))
        {
            while ($row = $result->fetch_assoc())
            {
                return $row["price"];
            }
        }
    }
    function insert_tour($strana, $gorod, $hotel, $startdate, $price, $duration)
    {
        $strana = $this->connection->real_escape_string($strana);
        $gorod = $this->connection->real_escape_string($gorod);
        $hotel = $this->connection->real_escape_string($hotel);
        $startdate = $this->connection->real_escape_string($startdate);
        $price = $this->connection->real_escape_string($price);
        $duration = $this->connection->real_escape_string($duration);
        $request="SELECT hotels.id from hotels where hotels.name=\"$hotel\"".
            "AND city=(SELECT cities.id FROM cities WHERE name=\"$gorod\"".
            "AND cities.country=\"$strana\")";
        if ($result = $this->connection->query($request))
        {
            $hotel = $result->fetch_assoc();
            $hotel_id = $hotel['id'];
            echo $hotel_id;
            $request = "INSERT INTO tours
(startdate, hotel, price,duration)
VALUES (\"$startdate\", \"$hotel_id\",
\"$price\",\"$duration\")";
            if ($result = $this->connection->query($request))
            {
                echo "Запись о туре выполнена.";
            }
            else
            {
                echo "Запись не выполнена. Пожалуйста, проверьте вводимые данные.";
            }
        }
        else
        {
            echo "Ошибка в запросе. Пожалуйста, проверьте вводимые данные.";
        }
    }
}
?>