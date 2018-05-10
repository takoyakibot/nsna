<?php

if (! function_exists('null_escape'))
{
    /**
     * いわゆるisnullやcoallese
     *
     * @param $v
     * @param $d
     * @return mixed
     */
    function null_escape($v, $d = '') { return empty($v) ? $d : $v; }
}