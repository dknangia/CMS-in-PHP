<?php

class Url
{

    /**
     * Redirect the request to the specified path
     * 
     * @param string $path Path were request needs to be redirected
     * 
     * @return void
     */
    public static function redirect($path)
    {
        $protocol = '';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
            $protocol = 'https';
        } else {
            $protocol = 'http';
        }

        //Redirect the user to another page
        header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . $path);
        exit;
    }
}
