<?php

namespace App\Classes;

class Redirect 
{
    /**
     * redirect to a specific page
     *
     * @param [type] $page
     * @return void
     */
    public static function to($page)
    {
        header("location: $page");
    }
    
    /**
     * redirect to same page
     *
     * @return void
     */
    public static function back()
    {
        $uri = $_SERVER['REQUEST_URI'];
        header("location: $uri");
    }
}