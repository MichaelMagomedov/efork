<?php

namespace Engine\Contracts\Provider;

use Engine\Contracts\App;

interface Base
{
    public function inject(App $app);
}