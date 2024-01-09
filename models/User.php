<?php

class User {

    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $password;

    static function getAll()
    {
        global $db;
        $result = $db->query("SELECT * FROM users");
        if ($result)
            return $result->fetch_all(MYSQLI_ASSOC);
    }

    static function user_checker($email, $db)
    {
        $sql = "SELECT * FROM users WHERE users_email = '$email'";
        $stmt = mysqli_stmt_init($db);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result)
            return $result->fetch_assoc();
        return false;
    }

    static function register($firstName ,$lastName, $email, $password,$db)
    {
        $sql = "INSERT INTO `users`(`users_email`, `users_password`, `users_firstName`, `users_lastName`) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($db);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $email, $password ,$firstName, $lastName,);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($db);
    }

}