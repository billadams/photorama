<?php

class CategoryDB {

    public static function get_all_categories() {
        $db = Database::DBConnect();

        $query = 'SELECT *
                  FROM categories';

        $statement = $db->prepare($query);
        $statement->execute();
        $categories = $statement->fetchAll();
        $statement->closeCursor();

        return $categories;
    }

    public static function get_user_images_by_category($category_id, $user_id)
    {
        $db = Database::DBConnect();

        $query = 'SELECT categories.category_id, category_name, 
                         image_id, image_path, caption, alt_text
                 FROM users
                    JOIN images ON users.user_id = images.user_id
                    JOIN categories ON images.category_id = categories.category_id
                 WHERE users.user_id = :user_id AND
                       categories.category_id = :category_id';

        $statement = $db->prepare($query);
        $statement->bindValue(":user_id", $user_id);
        $statement->bindValue(":category_id", $category_id);
        $statement->execute();
        $user_images_by_category = $statement->fetchAll();
        $statement->closeCursor();

        return $user_images_by_category;
    }
}