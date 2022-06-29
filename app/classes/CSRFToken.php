<?php
namespace App\Classes;

class CSRFToken 
{   
    /**
     * generate system token
     *
     * @return mixed
     */
    public static function _token()
    {
        if(!Session::has('token')){
            $randomToken = base64_encode(openssl_random_pseudo_bytes(32));
            Session::add('token', $randomToken);
        }
        return Session::get('token');
    }
    
    /**
     * check if the system token is equal to the request token
     *
     * @param [type] $requestToken
     * @param [type] $regenerate
     * @return bool
     */
    public static function verityCSRFToken($requestToken, $regenerate = true)
    {
        if(Session::has('token') && Session::get('token') === $requestToken) {
            
            if ($regenerate){
                Session::remove('token');
            }
            
            return true;
        }
        return false;
    }
}