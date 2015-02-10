<?php

namespace Linok\VideogameBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Linok\VideogameBundle\DependencyInjection\VideogameExtension;

class VideogameBundle extends Bundle
{
    public function __construct()
    {
        $this->extension = new VideogameExtension();
    }
}
