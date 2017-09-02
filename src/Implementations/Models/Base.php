<?php

namespace Engine\Implementations\Models;

use \Engine\Contracts\Models\Base as Contract;
use PDO;
use PDOStatement;

class Base implements Contract
{
    protected $table;

    private $connect;


    public function __construct()
    {

        $config = app()->configs()->get("database");

        $this->connect = new PDO(
            $config['pdo'] . ':host=' .
            $config['host'] . ';dbname=' .
            $config['database'],
            $config['user'],
            $config['password']
        );
    }


    public function row(string $query, array $fields = null):array
    {

        for ($i = 0; $i < sizeof($fields); $i++) {

            $fields[$i] = htmlspecialchars($fields[$i]);

        }

        $query = vsprintf(str_replace(array('%', '?'), array("'%%'", "'%s'"), $query), $fields);


        $sth = $this->connect->prepare($query);
        $sth->execute();


        if ($sth === false) {

            throw new \Exception("SQL invalid");
        }

        $result = $sth->fetchAll();

        return $result;
    }
}