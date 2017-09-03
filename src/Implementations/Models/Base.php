<?php

namespace Engine\Implementations\Models;

use \Engine\Contracts\Models\Base as Contract;
use JsonSerializable;
use PDO;
use PDOStatement;

class Base implements Contract, JsonSerializable

{
    protected $table;

    protected $visiable;

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

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        $jsonArr = [];
        foreach ($this->visiable as $fieldName) {

            $methodName = "get" . ucwords(strtolower($fieldName));
            $jsonArr[$fieldName] = call_user_func_array(array($this, $methodName), []);

        }
        return $jsonArr;
    }
}