<?php

class UtilsController
{
    public function isActive($uri)
    {
        return $_SERVER['REQUEST_URI'] === $uri ? ' itemActive' : '';
    }
}
