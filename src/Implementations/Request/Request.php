<?php
namespace Engine\Implementations\Request;

use \Engine\Contracts\Request\Request as Contract;

class Request implements Contract
{
    public function input(string $string):string
    {
        if (isset($_POST[$string])) {
            return $_POST[$string];
        }

        if (isset($_GET[$string])) {
            return $_GET[$string];
        }
    }

    public function url():string
    {
        return strtok($_SERVER["REQUEST_URI"], '?');
    }
}