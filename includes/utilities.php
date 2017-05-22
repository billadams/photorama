<?php
class Utilites {
    public static function hash_password($password)
    {
        $options = [
            'cost' => 10
        ];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT, $options);

        return $hashed_password;
    }
}