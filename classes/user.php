<?php

class User
{

    public $id;
    public $usernmae;
    public $password;

    /**
     * User class for authentication functions
     * 
     * @param string @username username 
     * @param string @password password 
     * 
     * @return boolean true on sucess and false on failure 
     */
    public static function authenticate($conn, $username, $password)
    {
        $sql = "SELECT * 
                FROM user
                WHERE username = :username";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(":username", $username, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        if ($user = $stmt->fetch())
            return password_verify($password, $user->password); 
    }

    public static function logout()
    {
    }
}
