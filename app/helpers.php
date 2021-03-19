<?php

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return ucfirst(utf8_encode ($date->formatLocalized('%d %B %Y')));
    }
}

if (!function_exists('truncate')) {
    function truncate($text,$limit)
    {
        return Illuminate\Support\Str::limit($text,$limit,$end='...');
    }
}

if (!function_exists('truncate')) {
    function truncate($text,$limit)
    {
        return Illuminate\Support\Str::limit($text,$limit,$end='...');
    }
}

if (!function_exists('getImage')) {
    function getImage($name, $thumb = false)
    {
        $url = "storage/images";
        if($thumb) $url .= '/thumbs';
        return asset("{$url}/{$name}");
    }
}
