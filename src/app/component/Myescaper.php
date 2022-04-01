<?php

namespace App\Component;

class Myescaper
{
    public function sanitize($param)
    {
        $para = $this->escaper->escapeHtml($param);
        return $para;
    }
}
