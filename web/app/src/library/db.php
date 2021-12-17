<?php
class DB {

    private $_conn = null;

    public function DB($host , $user ,  $pass , $database) {
        if (!$this->_conn = mysqli_connect($host , $user , $pass)) {
            die('Error: Could not make a database link using ' . $user . '@' . $host . '!');
        }
        if (!mysqli_select_db($this->_conn, $database)) {
            die('Error: Could not select a database ' . $database .'!');
        }
    }

    public function query($sql) {
        if(!$query_result = mysqli_query($this->_conn , $sql)) {
            die(myqsli_error($this->_conn));
        }
        $rows = array();
        while (($row = mysqli_fetch_assoc($query_result)) !== false) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function __destruct() {

        if ($this->_conn) {
            mysqli_close($this->_conn);
        }
    }
}