<?php

function isActive($uri)
{
    $request_uri = $_SERVER['REQUEST_URI'];

    return $request_uri === $uri ? 'itemActive' : '';
}

function decodeId($id, $time)
{
    $decode = $id / $time;
    return $decode;
}

function encodeId($id, $time)
{
    $encode = $id * $time;
    return $encode;
}

function secureQuery($query)
{
    $filtre = preg_replace("/[^a-zA-Z0-9=<> ]/", "", $query);
    return $filtre;
}
