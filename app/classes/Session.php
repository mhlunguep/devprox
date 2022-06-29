<?php

namespace App\Classes;

class Session
{
    /**
     * create a session
     *
     * @param [type] $name
     * @param [type] $value
     * @return mixed
     * @throws \Exception
     */
    public static function add($name, $value)
    {
        if ($name != '' && !empty($name) && $value != '' && !empty($value)) {
            return $_SESSION[$name] = $value;
        }
        throw new \Exception('Name and value required');
    }

    /**
     * get value from session
     *
     * @param [type] $name
     * @return mixed
     */
    public static function get($name)
    {
        return $_SESSION[$name];
    }

    /**
     * check if session exist
     *
     * @param [type] $name
     * @return boolean
     * @throws \Exception
     */
    public static function has($name)
    {
        if ($name != '' && !empty($name)) {
            return (isset($_SESSION[$name])) ? true : false;
        }
        throw new \Exception("Name is required");
    }

    /**
     * remove session
     *
     * @param [type] $name
     * @return void
     */
    public static function remove($name)
    {
        if (self::has($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * flash a message and unset old session
     *
     * @param [type] $name
     * @param [type] $value
     * @return mixed/null
     */
    public static function flash($name, $value = '')
    {
        if (self::has($name)) {
            $old_value = self::get($name);
            self::remove($name);

            return $old_value;
        } else {
            self::add($name, $value);
        }
        return null;

    }

}
