<?php

namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;

class GetTime extends AbstractHelper
{
    public function __invoke()
    {
        $dt = new \DateTime();
        return $dt->format('H:i:s');
    }
}
