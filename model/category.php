<?php
class Category {
    private $category_id;
    private $category_name;
    private $user_id;

    public function __construct($category_id = "", $category_name, $user_id) {
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->user_id = $user_id;
    }

//    public function create_category_instance($category_id, $category_name, $user_id) {
//        $category_instance = new self($category_id, $category_name, $user_id);
//    }

    public function get_category_id() {
        return $this->category_id;
    }

    public function set_category_id($category_id) {
        $this->category_id = $category_id;
    }

    public function get_category_name() {
        return $this->category_name;
    }

    public function set_category_name($category_name) {
        $this->category_name = $category_name;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function set_user_id($user_id) {
        $this->user_id = $user_id;
    }
}