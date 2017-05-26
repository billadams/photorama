<?php
class ImageDB {

    public function get_images_by_user_id($user_id) {
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

    public function get_images_by_category_id($category_id) {
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
}