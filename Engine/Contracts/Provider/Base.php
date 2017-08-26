<?php

namespace Engine\Contracts\Provider;

use Engine\Contracts\App;

interface Base
{
    function inject(App $app);
}