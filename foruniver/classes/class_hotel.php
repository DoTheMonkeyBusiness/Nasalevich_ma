<?php
/**
 * Created by PhpStorm.
 * User: ХХХ
 * Date: 16.04.2018
 * Time: 12:23
 */

class hotel extends country
{
    function show_description($city,$country)
    {
        $query = "SELECT distinct h.name, h.description, h.stars, h.photos ".
            "FROM hotels as h, cities as c ".
            "WHERE c.name= \"$city\" ".
            "AND c.country=\"$country\" ".
            "AND h.name=\"$this->name\" ".
            "AND c.id=h.city";
        if ($result = $this->connection->query($query))
        {
            while ($row = $result->fetch_assoc())
            {
// Создание строки звездочек для показа звездности отеля
                $st = "";
                for ($i = 0; $i < $row['stars']; $i++)
                    $st = $st."*";
                echo "<table border=0> <tr> <td>";
// Вывод картинки отеля
                $jpg = $row["photos"];
                echo "<img src='$jpg'>";
// Вывод названия отеля, его звездности и описания
                echo "</td><td valign=top> Отель ".$row['name']. $st."</td></tr>\n";
                echo "<tr><td colspan=2>". $row['description']."</td></tr></table>";
            }
        }
    }
    function insert_hotel($strana, $gorod, $hotel, $description, $stars, $foto)
    {
        $request="SELECT id from cities
where name = \"$gorod\" AND country =\"$strana\"";
        if ($result = $this->connection->query($request))
        {
            $city = $result->fetch_assoc();
            $city_id = $city['id'];
            $hotel = $this->connection->real_escape_string($hotel);
            $description = $this->connection->real_escape_string($description);
            $foto = $this->connection->real_escape_string($foto);
            $name = $this->connection->real_escape_string($stars);
            $strana = $this->connection->real_escape_string($strana);
            $request = "INSERT INTO hotels
(name, description, photos, stars,city)
VALUES (\"$hotel\", \"$description\", \"$foto\",
\"$stars\",\"$city_id\")";
            if ($result = $this->connection->query($request))
            {
                echo "Запись об отеле выполнена.";
            }
            else
            {
                echo "Запись не выполнена. Проверьте вводимые данные.";
            }
        }
        else
        {
            echo "Ошибка в запросе. Пожалуйста, проверьте вводимые данные.";
        }
    }
}
?>

