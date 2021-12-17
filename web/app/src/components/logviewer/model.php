<?php
class logviewerModel {
    /**
     * @var DB
     */
    private $db;
    public function __construct($obj) {
        if (isset($obj['db'])) {
            $this->db = $obj['db'];
        }
    }

    public function getCount($data) {
        $sql = "SELECT COUNT(*) FROM `log`";
        if(isset($data['filters']['type']) and $data['filters']['type'] <> "") {
            $sql .= " WHERE `type` = '" . $this->db->Quote($data['filters']['type']) . "'";
        }
        return $this->db->query($sql)[0]['COUNT(*)'];
    }
    public function getColumns() {
        return ['ts', 'type' , 'message'];
    }
    public function getData($data) {
        //TODO: сделать sqlbuilder
        //select ts + FLOOR(-86400 + RAND() * (172801)), FLOOR(1+RAND()*10) , message FROM `log`;
        $sql = "SELECT `ts`, `type` , `message` FROM `log`";
        if(isset($data['filters']['type']) and $data['filters']['type'] <> "") {
            $sql .= " WHERE `type` = '" . $this->db->Quote($data['filters']['type']) . "'";
        }

        $sql .= " ORDER BY `" . $this->db->Quote($data['order'])  . "` " . $this->db->Quote($data['orderby']) . ""
            . " LIMIT " . $this->db->Quote($data['start']) . ", " . $this->db->Quote($data['limit']);
        return $this->db->query($sql);
    }
    public function getTypes() {
        $sql = "SELECT DISTINCT `type` FROM log ORDER BY `type`";
        return $this->db->query($sql);
    }

    public function save($data) {
        $sql = "insert `log` (`ts`, `type`, `message`) values ("
            . "'" . $this->db->Quote($data['ts']). "',"
            . "'" . $this->db->Quote($data['type']). "',"
            . "'" . $this->db->Quote($data['message']). "'"

        .")";
        $this->db->query($sql);
        return true;
    }

}