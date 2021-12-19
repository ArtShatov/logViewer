<?php
class indexController {
    public function index() {
        template::render(__DIR__ . '/index.html');
    }
}