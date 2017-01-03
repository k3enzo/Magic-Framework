<?php

class model extends Dbase{

    private $_pdo ;
    private $_query = '';
    protected $table = '';
    protected $pk = '';

//    function __construct() {
//
//
//
//        if($this->table == ''){
//            $this->table = get_class($this);
//        }
//    }

    function get_rows($fields = '*', $where = ' 1=1 ', $order = 'ASC', $limit = 10) {
        $this->_query = "select $fields from {$this->table} where {$where} ORDER BY {$this->pk} $order LIMIT $limit";
        return $this->getAll($this->_query);
    }

    function get_row($fields = '*', $where = ' 1=1 ', $order = '', $limit = 10) {
        $this->_query = "select $fields from {$this->table} where {$where} ORDER BY {$this->pk} $order LIMIT $limit";
        return $this->getOne($this->_query);
    }

    function delete($id) {
        $this->_query = "delete from $this->table where id = '$id'";
        return $this->execute($this->_query);
    }

    function update($data, $where = ' 1 = 1 ') {
        $this->_query = " update {$this->table} set $data where $where";
        $this->execute($this->_query);
        return $this->_affected_rows;
    }

    function insert($fields, $data) {
        $this->_query = " insert into $this->table ($fields) VALUES ($data)";
        $this->execute($this->_query);
        return $this->_affected_rows;
    }

    function run($query) {
        $this->query = $query;
        $this->execute($this->_query);
        return $this->_affected_rows;
    }

    function last_query(){
        return $this->_query;
    }
}