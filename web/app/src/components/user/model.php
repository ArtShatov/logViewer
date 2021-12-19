<?php
class userModel {
    /**
     * @var DB
     */
    private $db;
    public function __construct($obj) {
        if (isset($obj['db'])) {
            $this->db = $obj['db'];
        }
    }
    public function save($data) {
        $user_id = intval($data['user_id']);
        if ($user_id == 0) {
            //insert
            $sql = "INSERT INTO `user`( 
                `email`, 
                `username`, 
                `fio`, 
                `password`) 
            VALUES (
                '".$this->db->Quote($data['email'])."',
                '".$this->db->Quote($data['username'])."',
                '".$this->db->Quote($data['fio'])."',
                '".$this->db->Quote($data['password'])."')";
            return $this->db->query($sql);
        } else {
            $user_id = $data['user_id'];
            unset($data['user_id']);
            $fields = [];
            foreach ($data as $field => $value) {
                $fields[] = "`" . $this->db->Quote($field) . "`='".$this->db->Quote($data[$field])."'";
            }
            $sql  = "UPDATE `user` SET " . implode(", " , $fields);
            $sql .= " WHERE user_id = '".$this->db->Quote($user_id)."'";
            $this->db->query($sql);
        }
    }
    function getUserById($user_id) {
        $sql = "SELECT * FROM `user` where `user_id` = '".$this->db->Quote($user_id) ."'";
        return $this->db->query($sql)[0];

    }
    function getUserByText($text) {
        $sql = "SELECT * FROM `user` where `email` = '".$this->db->Quote($text) ."'"
            ." OR `username` = '" . $this->db->Quote($text). "'";
        return $this->db->query($sql)[0];
    }
}