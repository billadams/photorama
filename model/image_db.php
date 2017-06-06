<?php
class ImageDB {

    public static function get_images_by_user_id($user_id) {
        $db = Database::DBConnect();

        $query = 'SELECT *
                 FROM images
                 WHERE user_id = :user_id';

        $statement = $db->prepare($query);
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $user_images = $statement->fetchAll();
        $statement->closeCursor();

        return $user_images;
    }

    public static function get_images_by_category_id($category_id) {
        $db = Database::DBConnect();

        $query = 'SELECT *
                 FROM images
                 WHERE category_id = :category_id';

        $statement = $db->prepare($query);
        $statement->bindValue(":category_id", $category_id);
        $statement->execute();
        $category_images = $statement->fetchAll();
        $statement->closeCursor();

        return $category_images;
    }

    public static function count_total_user_images($user_id) {
        $db = Database::DBConnect();

        $query = 'SELECT COUNT(*) AS image_total
                 FROM images
                 WHERE user_id = :user_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $num_images = $statement->fetch();
        $statement->closeCursor();

        return $num_images;
    }

    public static function count_total_user_categories($user_id) {
        $db = Database::DBConnect();

        $query = 'SELECT COUNT(DISTINCT category_id) AS category_total
                 FROM images
                 WHERE user_id = :user_id';

        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $num_categories = $statement->fetch();
        $statement->closeCursor();

        return $num_categories;
    }
}