<?php

class model extends Dbase{

    private $_pdo ;
    private $_query = '';
    protected $table = '';
    protected $pk = '';
    protected $fields = '*';
    protected $order = 'ASC';
    protected $limit = 100 ;
    private $where = ' 1=1 ';
    private $characters = ['=','!=','>','<','<=','>=','<=>','like'];

//    function __construct() {
//
//
//
//        if($this->table == ''){
//            $this->table = get_class($this);
//        }
//    }

    private function GetColumnName()
    {
        $names = $this->GetColumnNames("DESCRIBE ".$this->table);
        return $names;
    }

    function where($field,$character,$value = NULL)
    {
        if(!in_array($character,$this->characters) && empty($value))
        {
            $this->where = "`$field` = '{$character}'";
                return $this;
        }

        elseif (!in_array(strtolower($character),$this->characters) && !empty($value))
            exit(Not_valid_mysql_character.' - '.$character.' -');


        if(strtolower($character) == 'like')
            $value = '%'.$value.'%';

        $this->where = "`$field` {$character} '{$value}'";

        return $this;
    }

    public function get($limit = NULL,$fields = NULL)
    {

        $fields = empty($fields)? $this->fields : $fields;
        $limit = empty($limit)? $this->limit : $limit;

        $this->_query = "select {$fields} from {$this->table} where {$this->where} ORDER BY {$this->pk} {$this->order} LIMIT $limit";

        return $this->getAll($this->_query);
    }

    public function find($id)
    {
        return $this->where('id',$id)->get();

    }


    public function findAll($char)
    {
        $fields = $this->fields;

        if($this->fields == '*')
        {
            $fields = $this->GetColumnName();
            $fields = Helper::refactor($fields);
        }
        $fields = Helper::refactor($fields);


        foreach ($fields as $row)
        {
            $s = $this->where($row,'like',$char)->get();
            if(count($s) > 0)
                $data[] = $s;
        }

        return is_array($data) ? $data[0] : NULL;
        
        


    }

    function delete() {
        $this->_query = "delete from $this->table where ".$this->where;
        return $this->execute($this->_query);
    }

    function update($data) {
       $upd = null;
        if(is_array($data))
        {
            foreach($data as $row => $n)
            {
                $upd .=  !empty($upd)? ','."`$row` = '{$n}' " : "`$row` = '{$n}'" ;
            }
        }
        else
            $upd = $data;

        $this->_query = " update {$this->table} set {$upd} where ".$this->where;
        $this->execute($this->_query);
        return $this->_affected_rows;
    }

    function insert($data) {
        $this->_query = " insert into $this->table ({$this->where}) VALUES ($data)";
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