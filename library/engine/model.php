<?php

class model extends Dbase{

    private $_pdo ;
    private $_query = '';
    protected $table = '';
    protected $pk = '';
    protected $fields = '*';
    protected $order = 'ASC';
    protected $limit = 100 ;
    private $where = '1=1';
    private $characters = ['=','!=','>','<','<=','>=','<=>','like'];
    private $_JoinSeted = NULL;
    protected $_JoinField = NULL;
    private $character = ['b','c','d','e','f'];

//    function __construct() {
//
//
//
//        if($this->table == ''){
//            $this->table = get_class($this);
//        }
//    }

    protected function GetColumnName($get = NULL)
    {
        if($get == 'default')
        {
            return $this->fields;
        }

        $names = $this->GetColumnNames("DESCRIBE ".$this->table);
        return $names;
    }

    protected function Getfield($field = NULL)
    {
            if(!empty($field)){
                  if(is_array($field)) {

                      foreach ($field as $row)
                      {
                          $ring .= empty($ring)? $this->table.'.'.$row : ','.$this->table.'.'.$row ;
                      }
                  }
                return $field;
            }

            if(empty($this->fields) or $this->fields == "*"){
                $field = $this->GetColumnName();

                foreach ($field as $row)
                {
                    $ring .= empty($ring)? $this->table.'.'.$row : ','.$this->table.'.'.$row ;
                }

                 return $ring;
            }



                    $field = !is_array($this->fields)?
                        Helper::refactor($this->fields)
                            :
                             $this->fields;

                    foreach ($field as $row)
                    {
                        $ring .= empty($ring)? $this->table.'.'.$row : ','.$this->table.'.'.$row ;
                    }

            return $ring;
    }

    private function SetToData($data)
    {
        $values = NULL;
        foreach ($data as $row)
        {
            $values .= !empty($values)? ",'{$row}'" : "'{$row}'";
        }

        return $values;
    }

    function where($field,$character,$value = NULL)
    {
        if(!in_array($character,$this->characters) && empty($value))
        {
            if($this->where == '1=1')
                $this->where = "`$field` = '{$character}'";
            else
                $this->where .= " and `$field` = '{$character}'";
                return $this;
        }

        elseif (!in_array(strtolower($character),$this->characters) && !empty($value))
            exit(Not_valid_mysql_character.' - '.$character.' -');


        if(strtolower($character) == 'like')
            $value = '%'.$value.'%';

        if(empty($this->where))
            $this->where = "`$field` {$character} '{$value}'";
        else
            $this->where = " and `$field` {$character} '{$value}'";

        return $this;
    }


    public function OrWhere($field,$character,$value = NULL)
    {
        if(!in_array($character,$this->characters) && empty($value))
        {
            if($this->where == '1=1')
                $this->where = "`$field` = '{$character}'";
            else
                $this->where .= " or `$field` = '{$character}'";
            return $this;
        }

        elseif (!in_array(strtolower($character),$this->characters) && !empty($value))
            exit(Not_valid_mysql_character.' - '.$character.' -');


        if(strtolower($character) == 'like')
            $value = '%'.$value.'%';

        if(empty($this->where))
            $this->where = "`$field` {$character} '{$value}'";
        else
            $this->where .= " or `$field` {$character} '{$value}'";

        return $this;
    }

    public function get($limit = NULL,$fields = NULL)
    {
        $limit = empty($limit)? $this->limit : $limit;

        $fields = $this->Getfield($fields);

        if(empty($this->_JoinSeted)) {
            $this->_query = "select {$fields} from {$this->table} where {$this->where} ORDER BY {$this->pk} {$this->order} LIMIT $limit";
        }
        else {
            $this->_query = "
                select {$this->Getfield()},".$this->_JoinField." 
                    from {$this->table} 
                        ".$this->_JoinSeted."
                    where {$this->where} 
                        ORDER BY {$this->table}.{$this->pk} {$this->order} LIMIT $limit
                ";
        }

            if($limit == 1)
            {
                return $this->getOne($this->_query);
            }
        return $this->getAll($this->_query);
    }

    public function find($id)
    {

        return $this->where('id',$id)->get();
    }


    public function findAll($char)
    {
        $fields = $this->fields;
        $fields = is_array($fields)? Helper::refactor($fields) : $fields;

        if($this->fields == '*')
        {
            $fields = $this->GetColumnName();
            $fields = Helper::refactor($fields);
        }
        if(!is_array($fields))
            $fields = Helper::refactor($fields);


        foreach ($fields as $row)
        {
            $s = $this->where($row,'like',$char)->get();
            if(count($s) > 0)
                $data[] = $s;
        }

        return is_array($data) ? $data[0] : NULL;

    }

    public function update($data) {
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

    public function insert($data) {
        $fields = $this->Getfield();

        $data = $this->SetToData($data);

        $this->_query = "insert into $this->table ({$fields}) VALUES ($data)";


        $this->execute($this->_query);
        return $this->_affected_rows;
    }

    public function delete() {
        $this->_query = "delete from $this->table where ".$this->where;
        return $this->execute($this->_query);
    }

    protected function Joiner($JoinModelName,$JoinKeyName,$PrimaryKey = NULL)
    {


           if(class_exists($JoinModelName._Model))
           {

               $model = Load::model($JoinModelName);
               $tableName = $model->getTable();
                    $fields = $model->Getfield();


                    $fields = Helper::refactor(
                        array_diff(
                            Helper::refactor($fields),[$tableName.'.'.$JoinKeyName,$tableName.'.id']
                        )
                    );
//                        if(!is_array($fields))
////                            $fields = Helper::refactor($fields);
////               $fields = array_diff($fields,[$JoinKeyName,'id']);


               $query = '
                        JOIN '.$tableName.'
                        ON '.$this->table.'.'.(empty($PrimaryKey)?$this->pk:$PrimaryKey).' = '.$tableName.'.'.$JoinKeyName.' 
                        
               ';

               $this->_JoinSeted .= $query;
               $this->_JoinField = $fields;
               return  $this;

           }
    }

    function run($query) {
        $this->query = $query;
        $this->execute($this->_query);
        return $this->_affected_rows;
    }

    protected function getTable()
    {
        return $this->table;
    }

    function last_query(){
        return $this->_query;
    }
}