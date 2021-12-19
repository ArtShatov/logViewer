<?php
class template {
    public function render ($template, $data = null) {
        if (!is_null($data)) {
            extract($data);
        }
        include($template);
    }
}