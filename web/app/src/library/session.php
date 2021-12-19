<?php
class Session {
    public function __construct() {
        session_start();
    }
    public function getVal($key , $defaultValue = null) {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : $defaultValue;
    }
    public function setVal($key , $val) {
        return $_SESSION[$key] = $val;
    }
    public function destroy() {
        session_destroy();
    }
}