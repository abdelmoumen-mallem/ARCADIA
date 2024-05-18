<?php

function isActive($uri)
{
    // Récupérer l'URL demandée
    $request_uri = $_SERVER['REQUEST_URI'];

    // Vérifier si l'URL demandée correspond à l'URI spécifiée
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
