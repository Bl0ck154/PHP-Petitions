<?php

class ORM
{
    protected $object;
    protected $dbh;
    public static $table;
    protected $id;
    protected $_queryOptions = [];
    function __construct($id = -1)
    {
        $this->dbh = new DB();

        if($id > -1) {
            $this->id = $id;
            $sth = DB::getInstance()->prepare('SELECT * FROM '.$this::$table.' WHERE id='.$id);
            $sth->execute();
            $this->object = $sth->fetch(PDO::FETCH_OBJ);
        } else {
            $this->object = new stdClass();
        }
    }

    function __get($key)
    {
        if(isset($this->object->$key)) {
            return $this->object->$key;
        } elseif(isset($this->$key)) {
            return $this->$key;
        }
    }

    function __set($key, $value)
    {
        if(isset($this->object)) {
            $this->object->$key = $value;
        } elseif(isset($this->$key)) {
            $this->$key = $value;
        }
    }

    function save()
    {
        if(isset($this->id)) {
            $query = 'UPDATE `'.$this::$table.'` SET ';
            $values = [];
            foreach ($this->object as $key => $value)
            {
                $query .= '`'.$key.'`=?,';
                $values[] = $value;
            }
            $query = rtrim($query,',').' WHERE id='.$this->id;
            $sth = DB::getInstance()->prepare($query);
            $sth->execute($values);
        } elseif (!empty($this->object)) {
            $query = 'INSERT INTO `'.$this::$table.'` (';
            $marks = '';
            $params = [];
            foreach ($this->object as $key => $value)
            {
                $query .= $key.',';
                $marks .= '?,';
                $params[] = $value;
            }
            $query = rtrim($query,',').') VALUES('.rtrim($marks,',').')';
            $sth = DB::getInstance()->prepare($query);
            $sth->execute($params);
        }
    }

    function remove()
    {
        if(isset($this->id)) {
            $query = 'DELETE FROM `'.$this::$table.'` WHERE id='.$this->id;
            $sth = DB::getInstance()->prepare($query);
            $sth->execute();
        }
    }

    function select()
    {
        $args = func_get_args();
        if(count($args) > 0) {
            $this->_queryOptions['select'] = $args;
        }
        return $this;
    }

    function join()
    {
        $args = func_get_args();
        /*
         * $param1 - Класс прикрепляемый
         * $param2 - поле таблицы прикрепляемого класа
         * $param3 - поле главной таблицы
        */
        if(count($args) == 3) {
            $this->_queryOptions['join'] = $args;
        }
        return $this;
    }

    function where($assoc)
    {
        if(is_array($assoc)) {
            $this->_queryOptions['where'] = $assoc;
        }
        return $this;
    }

    function limit()
    {
        $args = func_get_args();

        if(count($args) == 1 || count($args) == 2) {
            foreach ($args as $val) {
                if(!is_numeric($val))
                    return;
            }

            $this->_queryOptions['limit'] = $args;
        }
        return $this;
    }

    function getRows()
    {
        return $this->execute();
    }

    function getRow()
    {
        $result = $this->limit(1)->getRows();
        if(!empty($result)) {
            $this->object = $result[0];
            $this->id = isset($this->object->id) ? $this->object->id : $this->object->pid; //  ID
            return $this;
        }
        return false;
    }

    function execute()
    {
        $query = 'SELECT ';

        if(!isset($this->_queryOptions['select'])) {
            $query .= '*';
        } else {
            $query .= implode(',', $this->_queryOptions['select']);
        }

        $query .= ' FROM `'.$this::$table.'`';

        if(isset($this->_queryOptions['join'])) {
            $join = $this->_queryOptions['join'];
            if($join[0] instanceof ORM) {
                $joinTable = $join[0]::$table;
            } elseif (is_string($join[0])) {
                $joinTable = $join[0];
            }

            $query .= ' JOIN `'.$joinTable
                .'` ON '.$joinTable.'.'.$join[1].'='.$this::$table.'.'.$join[2];
        }

        if(isset($this->_queryOptions['where'])) {
            $where = $this->_queryOptions['where'];

            $where = array_map(function ($entry) { return '\''.$entry.'\'';}, $where);
            $result = [];
            foreach ($where as $key => $value) {
                $result[] = $key.'='.$value;
            }

            $query .= ' WHERE ';
            $query .= implode(' AND ', $result);
        }

        if(isset($this->_queryOptions['limit'])) {
            $query .= ' LIMIT ';
            $query .= implode(', ', $this->_queryOptions['limit']);
        }

        $sth = DB::getInstance()->prepare($query);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    function lastInsertId()
    {
        return DB::getInstance()->lastInsertId();
    }
}