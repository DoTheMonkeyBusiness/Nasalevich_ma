<?php
/**
 * Created by PhpStorm.
 * User: ХХХ
 * Date: 16.04.2018
 * Time: 12:20
 */

class baza
{
// Задание констант класса
    const USERNAME = 'root';
    const PASSWORD = '';
    const DBNAME = 'firma';
    const SERVER = 'localhost';
    /*
    Конструктор класса устанавливает соединение с базой данных
    */
    function __construct($name = NULL)
    {
        if ($mysqli = new mysqli(self::SERVER, self::USERNAME, self::PASSWORD,
            self::DBNAME))
        {
            $this->connection = $mysqli;
        }
        else
        {
            echo "Не удается соединиться с сервером MySQL";
            exit;
        }
        if ($name)
        {
            $this->name = $name;
        }
    }
    function show_country_list()
    {
        $quest = "SELECT name FROM countries";
        if ($result = $this->connection->query($quest))
        {
            while ($row = $result->fetch_assoc())
            {
                $spisok[] = $row['name'];
            }
            $result->close();
            return $spisok;
        }
    }
    function _desctruct()
    {
        $this->connection->close();
    }
}
?>