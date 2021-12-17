<?php
class logviewerController {
    private $model = null;

    public function __construct($objects) {
        if (isset($objects['model'])) {
            $this->model = $objects;
        }
    }

    public function index() {

    }
}