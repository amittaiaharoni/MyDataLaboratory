<?php

namespace MyDataLab\Bundle\FrontendBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class MyDataLabFrontendBundle extends Bundle
{

    public function getParent()
    {
        return 'FOSUserBundle';
    }

}
