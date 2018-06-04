<?php
/**
 * Created by PhpStorm.
 * User: ХХХ
 * Date: 16.04.2018
 * Time: 12:22
 */

class city extends country
{
    function insert_city($country, $name, $description)
    {
        $country = $this->connection->real_escape_string($country);
        $name = $this->connection->real_escape_string($name);
        $description = $this->connection->real_escape_string($description);
        $request = "INSERT INTO cities (name, description, country)
VALUES (\"$name\", \"$description\", \"$country\")";
        if ($result = $this->connection->query($request))
        {
            echo "Запись сведений о городе выполнена.";
        }
        else
        {
            echo "Запись не выполнена. Пожалуйста, проверьте вводимые данные.";
        }
    }
}
?>