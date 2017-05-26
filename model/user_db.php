<?php
class UserDB {

    public static function check_unique_username($username)
    {
        $db = Database::DBConnect();

        $query = 'SELECT *
                  FROM users
                  WHERE username = :username';

        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $row_count = $statement->rowCount();
        $statement->closeCursor();

        return $row_count;
    }

    public static function add_new_user(User $user)
    {
        $db = Database::DBConnect();

        $username = $user->get_username();
        $email = $user->get_email();
        $password = $user->get_password();

        $query = 'INSERT INTO users
                    (username, email, password)
                  VALUES
                    (:username, :email, :password)';

        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function update_user(User $user)
    {
        $db = Database::DBConnect();
        $user_id = $user->get_user_id();
        $email = $user->get_email();
        $password = $user->get_password();

        $query = 'UPDATE users
                  SET email = :email,
                      password = :password
                  WHERE user_id = :user_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function get_user_by_id($user_id)
    {
        $db = Database::DBConnect();

        $query = 'SELECT *
                 FROM users
                 WHERE user_id = :user_id';

        $statement = $db->prepare($query);
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();

        return $user;
    }

    public static function get_user_by_username($username)
    {
        $db = Database::DBConnect();

        $query = 'SELECT *
                 FROM users
                 WHERE username = :username';

        $statement = $db->prepare($query);
        $statement->bindValue(":username", $username);
        $statement->execute();
        $row = $statement->fetch();
        $statement->closeCursor();

        return $row;
    }

    public static function get_all_users($user_id = NULL)
    {
        $db = Database::DBConnect();

        $query = 'SELECT *
                  FROM users
                  WHERE user_id != :user_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':username', $user_id);
        $statement->execute();
        $rows = $statement->fetchAll();
        $statement->closeCursor();

        return $rows;
    }
}