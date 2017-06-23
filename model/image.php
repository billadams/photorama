<?php
class Image {

    private $image_id;
    private $image_path;
    private $caption;
    private $alt_text;
    private $category_id;
    private $user_id;

    public function __construct($image_id, $image_path, $caption, $alt_text, $category_id, $user_id) {
        $this->image_id = $image_id;
        $this->image_path = $image_path;
        $this->caption = $caption;
        $this->alt_text = $alt_text;
        $this->category_id = $category_id;
        $this->user_id = $user_id;
    }

    public function get_image_id() {
        return $this->image_id;
    }

    public function set_image_id($image_id) {
        $this->image_id = $image_id;
    }

    public function get_image_path() {
        return $this->image_path;
    }

    public function set_image_path($image_path) {
        $this->image_path = $image_path;
    }

    public function get_image_caption() {
        return $this->caption;
    }

    public function set_image_caption($caption) {
        $this->caption = $caption;
    }

	public function get_image_alt_text() {
		return $this->alt_text;
	}

	public function set_image_alt_text($alt_text) {
		$this->alt_text = $alt_text;
	}

    public function get_category_id() {
        return $this->category_id;
    }

    public function set_category_id($category_id) {
        $this->category_id = $category_id;
    }

    public function get_user_id() {
        return $this->user_id;
    }

    public function set_user_id($user_id) {
        $this->user_id = $user_id;
    }
}