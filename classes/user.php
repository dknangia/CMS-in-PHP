<?php

class User
{

    /**
     * User class for authentication functions
     * 
     * @param string @username username 
     * @param string @password password 
     * 
     * @return boolean true on sucess and false on failure 
     */
    public static function authenticate($username, $password)
    {
        return $username == 'dnangia' && $password == "1234";
    }

    public static function logout()
    {
    }
}
