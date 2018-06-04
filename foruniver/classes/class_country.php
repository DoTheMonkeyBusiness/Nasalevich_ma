<?php
/**
 * Created by PhpStorm.
 * User: ХХХ
 * Date: 16.04.2018
 * Time: 12:22
 */

class country extends baza
{
    /*
    Метод show_description() выводит описание объекта.
    Выборка данных производится из таблицы, имя которой определяется
    в зависимости от класса, из которого вызывается метод.
    */
    function show_description($country = NULL)
    {
        if ($this instanceof country)
            $quest = "SELECT description FROM countries WHERE name=\"$this->name\"";
        if ($this instanceof city)
            $quest="SELECT description FROM cities WHERE name=\"$this->name\" AND country=\"$
country\"";
// Запрос описания объекта - страны или города
        if ($result = $this->connection->query($quest))
        {
            $row = $result->fetch_assoc();
            $opisanie = $row['description'];
        }
        $result->close();
        return $opisanie;
    }
    /*
    Вывод списка городов в выбранной стране
    */
    function show_city_list()
    {
        $request="SELECT name FROM cities WHERE country=\"$this->name\"";
        if ($result = $this->connection->query($request))
        {
            while ($row = $result->fetch_assoc())
            {
                $spisok[] = $row['name'];
            }
            $result->close();
            return $spisok;
        }
    }
    /*
    Самое дешевое предложение по выбранной стране
    */
    function min_off()
    {
        $request = "SELECT MIN( t.price ) AS min_offer ".
            "FROM cities AS c, hotels AS h, tours AS t ".
            "WHERE t.hotel = h.id ".
            "AND c.id = h.city ".
            "AND c.country = \"$this->name\"";
        if ($result = $this->connection->query($request))
        {
            $row = $result->fetch_assoc();
            return $row['min_offer'];
        }
    }
    function insert_country($name, $description)
    {
        $name = $this->connection->real_escape_string($name);
        $description = $this->connection->real_escape_string($description);
        $request = "INSERT INTO countries (name, description) VALUES (\"$name\",
\"$description\")";
        if ($result = $this->connection->query($request))
        {
            echo "Запись о стране выполнена.";
        }
        else
        {
            echo "Запись не выполнена. Пожалуйста, проверьте вводимые данные.";
        }
    }
}
?>