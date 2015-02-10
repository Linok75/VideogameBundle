<?php

namespace linok\videogameBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use linok\videogameBundle\DependencyInjection\videogameExtension;

class videogameBundle extends Bundle
{
    public function __construct()
    {
        $this->extension = new videogameExtension();
    }
}
