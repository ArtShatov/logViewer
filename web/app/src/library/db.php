<?php
class DB {

    private $connector = null;

    public function __construct($host , $user ,  $pass , $database) {
        if (!($this->connector = mysqli_connect($host , $user , $pass))) {
            die('Error: Could not make a database link using ' . $user . '@' . $host . '!');
        }
        if (!mysqli_select_db($this->connector, $database)) {
            die('Error: Could not select a database ' . $database .'!');
        }
    }

    public function query($sql) {
        if(!($query_result = mysqli_query($this->connector , $sql))) {
            die(mysqli_error($this->connector));
        }
        $rows = array();

        while ($row = mysqli_fetch_assoc($query_result)) {
            $rows[] = $row;
        }
        return $rows;
    }
    public function Quote($string) {
        return mysqli_real_escape_string($this->connector , $string);
    }

    public function __destruct() {
        if ($this->connector) {
            mysqli_close($this->connector);
        }
    }
}