<?php

class Logg
{
    private $sql;
    private $action;
    private $class;
    private $value;
    private $logs;

    public function __construct($sql){
        $this->sql = $sql;
    }


     public function saveEvent($className, $action, $value){
        $query = "
                INSERT INTO logs (`class`, `action`, `value`, time)
                VALUES('".$className."','".$action."', '".json_encode($value)."', now())
        ";
        $insert = mysqli_query($this->sql, $query);
    }


    public function getAllLogs(){
        $query ="select * from logs order by time";

        $result = mysqli_query($this->sql, $query);

        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        if(!empty($rows))
        return $rows;
    }

    public function getLastEvents(){
        $query ="SELECT *, MAX(time) FROM logs GROUP BY class;";

        $result = mysqli_query($this->sql, $query);

        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        if(!empty($rows))
        return $rows;
    }

}