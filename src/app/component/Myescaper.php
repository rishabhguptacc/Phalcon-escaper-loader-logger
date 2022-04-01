<?php

namespace App\Component;
use Phalcon\Escaper;


class Myescaper
{
    public function sanitize($param)
    {   $escaper = new Escaper();
        $para = $escaper->escapeHtml($param);
        return $para;
    }
}
