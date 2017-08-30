<?php

namespace Engine\Contracts\Middleware;

use Engine\Contracts\App;

interface Base
{
    public function handle(App $app);
}