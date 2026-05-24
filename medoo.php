<?php
class Medoo {
    private $conn;
    public function __construct($host, $user, $pass, $db) {
        $this->conn = new mysqli($host, $user, $pass, $db);
        if ($this->conn->connect_error) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
        $this->conn->set_charset('utf8mb4');
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function escape($s) {
        return $this->conn->real_escape_string($s);
    }

    public function insert($table, $data) {
        $cols = implode(',', array_map(function($c){ return "`".$c."`"; }, array_keys($data)));
        $vals = implode(',', array_map(function($v){ return "'" . $this->escape($v) . "'"; }, array_values($data)));
        $sql = "INSERT INTO `{$table}` ({$cols}) VALUES ({$vals})";
        $res = $this->query($sql);
        if ($res) return $this->conn->insert_id;
        return false;
    }

    public function select($table, $columns = '*', $where = null) {
        $cols = '*';
        if (is_array($columns)) {
            $cols = implode(',', array_map(function($c){ return is_string($c) ? "`{$c}`" : $c; }, $columns));
        } elseif (is_string($columns)) {
            $cols = $columns;
        }
        $sql = "SELECT {$cols} FROM `{$table}`";
        $conds = [];
        $order = '';
        if (is_array($where)) {
            if (isset($where['ORDER'])) {
                $o = $where['ORDER'];
                if (is_array($o)) {
                    foreach ($o as $k => $v) { $order = " ORDER BY `{$k}` " . (strtoupper($v) === 'DESC' ? 'DESC' : 'ASC'); }
                } elseif (is_string($o)) { $order = " ORDER BY {$o}"; }
                unset($where['ORDER']);
            }
            foreach ($where as $k => $v) {
                $conds[] = "`{$k}`='" . $this->escape($v) . "'";
            }
        }
        if (count($conds)) $sql .= ' WHERE ' . implode(' AND ', $conds);
        $sql .= $order;
        return $this->query($sql);
    }

    public function update($table, $data, $where) {
        $sets = [];
        foreach ($data as $k => $v) {
            $sets[] = "`{$k}`='" . $this->escape($v) . "'";
        }
        $conds = [];
        if (is_array($where)) {
            foreach ($where as $k => $v) { $conds[] = "`{$k}`='" . $this->escape($v) . "'"; }
        } else {
            $conds[] = $where;
        }
        $sql = "UPDATE `{$table}` SET " . implode(', ', $sets) . " WHERE " . implode(' AND ', $conds);
        return $this->query($sql);
    }

    public function delete($table, $where) {
        $conds = [];
        if (is_array($where)) {
            foreach ($where as $k => $v) { $conds[] = "`{$k}`='" . $this->escape($v) . "'"; }
        } else {
            $conds[] = $where;
        }
        $sql = "DELETE FROM `{$table}` WHERE " . implode(' AND ', $conds);
        return $this->query($sql);
    }

    public function close() { $this->conn->close(); }
}
