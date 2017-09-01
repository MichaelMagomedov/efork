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


    public function row(string $query, array $fields = null):PDOStatement
    {

        for ($i = 0; $i < sizeof($fields); $i++) {

            $fields[$i] = htmlspecialchars($fields[$i]);

        }

        $query = vsprintf(str_replace(array('%', '?'), array('%%', '%s'), $query), $fields);

        return $this->connect->query($query);
    }
}