<?php

function isActive($uri)
{
    $request_uri = $_SERVER['REQUEST_URI'];

    return $request_uri === $uri ? 'itemActive' : '';
}

function decodeId($id, $time)
{
    if ($id > $time) {
        $decode = $id / $time;
    } else {
        $decode = $time / $id;
    }
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

function convertDate($date, $time)
{
    $date = new DateTime($date);
    if ($time) {
        return $date->format('d/m/Y H:i:s');
    } else {
        return $date->format('d/m/Y');
    }
}

function encodeTokenCsrf()
{
    $sessionUser = $_SESSION['user_arcadia'];
    $cookieUser = $_COOKIE['user_arcadia'];
    if (!empty($cookieUser) && !empty($sessionUser) && $sessionUser == $cookieUser) {
        $attribut = substr($sessionUser, 0, 2);
        return base64_encode($sessionUser) . $attribut;
    } else {
        return false;
    }
}

function decodeTokenCsrf($token)
{
    $tokenAttribut = substr($token, 0, -2);
    return base64_decode($tokenAttribut);
}

function block($csrf)
{
    $sessionUser = $_SESSION['user_arcadia'];
    $cookieUser = $_COOKIE['user_arcadia'];
    if (!empty($cookieUser) && !empty($sessionUser) && $sessionUser == $cookieUser) {
        if ($csrf == $_SESSION['user_arcadia']) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
