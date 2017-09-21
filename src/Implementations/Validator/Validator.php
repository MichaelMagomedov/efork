<?php

namespace Engine\Implementations\Validator;

use Engine\Contracts\Request\Request;
use \Engine\Contracts\Validator\Validator as Contract;

class Validator implements Contract
{
    private $request;

    private $associate;

    public function __construct()
    {
        $this->request = app()->components()->make(Request::class);

        $this->associate["req"] = function (string $obj) {
            return empty($obj);
        };

        $this->associate["min"] = function (string $obj, int $length) {
            return strlen($obj) < $length;
        };

        $this->associate["email"] = function (string $obj, int $length) {
            if (preg_match(
                    '/^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u', $obj) == 1
            )
                return true;

            return false;
        };
        
        $this->associate["max"] = function (string $obj, int $length) {
            return strlen($obj) > $length;
        };
    }


    public function validate(array $rules):bool
    {
        foreach ($rules as $varName => $varRule) {

            $ruleArr = explode("|", $varRule);

            foreach ($ruleArr as $rule) {

                $charPos = strpos($rule, "{");

                if ($charPos === false) {

                    $command = $rule;

                    if ($this->associate[$command]($this->request->input($varName))) {

                        return false;

                    }


                } else {

                    $command = substr($rule, 0, $charPos);

                    preg_match_all('/\{(.+)\}/U', $rule, $arg);

                    if ($this->associate[$command]($this->request->input($varName), $arg[1][0])) {

                        return false;;
                    }
                }

            }
        }

        return true;
    }
}