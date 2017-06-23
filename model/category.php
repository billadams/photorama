<?php
class Category {
    private $category_id;
    private $category_name;
    private $category_images = array();

    public function __construct($category_id = "", $category_name, $category_images) {
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->category_images[] = $category_images;
    }

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

	public function get_category_images() {
		return $this->category_images;
	}

	public function set_category_images($category_images) {
		$this->category_images[] = $category_images;
	}
}