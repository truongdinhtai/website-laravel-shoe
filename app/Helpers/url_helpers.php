<?php


if( !function_exists('replace_url'))
{
    function replace_url($url)
    {
        return parse_url($url)['path'] ?? '';
    }
}
