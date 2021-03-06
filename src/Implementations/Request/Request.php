<?php
namespace Engine\Implementations\Request;

use \Engine\Contracts\Request\Request as Contract;

class Request implements Contract
{
    public function input(string $string)
    {
        if (isset($_POST[$string])) {
            return $_POST[$string];
        }

        if (isset($_GET[$string])) {
            return $_GET[$string];
        }

        $object = json_decode(file_get_contents("php://input"));

        if (isset($object->$string)) {
            return $object->$string;
        }
        return null;
    }

    public function url():string
    {
        return strtok($_SERVER["REQUEST_URI"], '?');
    }

    private function makeVariable(array $startArray, array &$resultArray)
    {
        foreach ($startArray as $key => $value) {
            $resultArray[$key] = $value;
        }
    }

    public function all():array
    {
        $variable = [];
        $this->makeVariable($_GET, $variable);
        $this->makeVariable($_POST, $variable);
        return $variable;
    }

    public function file(string $name)
    {
        if (isset($_FILES[$name])) {
            return $_FILES[$name];
        } else {
            return null;
        }
    }
}