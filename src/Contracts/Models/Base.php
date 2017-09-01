<?php

namespace Engine\Contracts\Models;

use PDOStatement;

interface Base
{
    public function row(string $query, array $fields = null):PDOStatement;
}