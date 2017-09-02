<?php
namespace Engine\Contracts\Validator;


interface Validator
{
    public function validate(array $rules):bool;
}