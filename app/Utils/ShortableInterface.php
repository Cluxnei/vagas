<?php

namespace App\Utils;

interface  ShortableInterface
{
    /**
     * Returns short substring from given string
     *
     * @param [string] $string
     * @return string
     */
    public function short($string);
}
