<?php

class UtilsController
{
    public function isActive($uri)
    {
        return $_SERVER['REQUEST_URI'] === $uri ? ' itemActive' : '';
    }

    public function test()
    {
        return 'ok';
    }
}
