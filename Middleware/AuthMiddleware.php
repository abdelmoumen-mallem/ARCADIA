<?php

function middleware_auth()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_COOKIE['user_arcadia']) && isset($_SESSION['user_arcadia'])) {
        // Vérifier si les valeurs du cookie et de la session correspondent
        if ($_COOKIE['user_arcadia'] == $_SESSION['user_arcadia']) {
            return true;
        }
    }
    return false;
}
