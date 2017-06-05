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

    public static function add_new_user($username, $email, $password)
    {
        $db = Database::DBConnect();

//        $username = $user->get_username();
//        $email = $user->get_email();
//        $password = $user->get_password();
        $member_since = date('Y-m-d H:i:s');

        $query = 'INSERT INTO users
                    (username, email, password, member_since)
                  VALUES
                    (:username, :email, :password, :member_since)';

        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':member_since', $member_since);
        $statement->execute();
        $statement->closeCursor();

        return $db->lastInsertId();
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

    public static function get_all_users()
    {
        $db = Database::DBConnect();

        $query = 'SELECT *
                  FROM users';

        $statement = $db->prepare($query);
        $statement->execute();
        $users = $statement->fetchAll();
        $statement->closeCursor();

        return $users;
    }

    public static function update_profile_image($image_path, $user_id)
    {
        $db = Database::DBConnect();

        $query = 'UPDATE users
                  SET profile_image = :profile_image
                  WHERE user_id = :user_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->bindValue(':profile_image', $image_path);
        $statement->execute();
        $statement->closeCursor();
    }

    public static function get_category_images_by_user($user_id)
    {
        $db = Database::DBConnect();

        $query = 'SELECT categories.category_id, category_name, 
                         image_id, image_path, caption
                 FROM users
                    JOIN images ON users.user_id = images.user_id
                    JOIN categories ON images.category_id = categories.category_id
                 WHERE users.user_id = :user_id';

        $statement = $db->prepare($query);
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $user_images = $statement->fetchAll();
        $statement->closeCursor();

        return $user_images;
    }

    public static function get_user_images_by_category_id($category_id) {

        $db = Database::DBConnect();

        $query = 'SELECT image_path, caption
                  FROM users
                     JOIN images ON users.user_id = images.user_id
                     JOIN categories ON images.category_id = categories.category_id
                  WHERE categories.category_id = :category_id';

        $statement = $db->prepare($query);
        $statement->bindValue(":category_id", $category_id);
        $statement->execute();
        $user_images = $statement->fetchAll();
        $statement->closeCursor();

        return $user_images;
    }
}