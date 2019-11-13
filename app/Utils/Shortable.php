<?php

namespace App\Utils;

trait Shortable
{
    public $shortLength = 30;

    public function short($string)
    {
        return strlen($string) > $this->shortLength ? substr($string, 0, $this->shortLength) . '...' : $string;
    }
}
