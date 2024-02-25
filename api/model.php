<?php

class VacModel
{   
    private $conn;
    private $table_name = 'vacs';


    public $id;
    public $lang;
    public $title;
    public $company;
    public $url;
    public $salary;
    public $info;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function read()
    {
        $query = "select 
        name, lang, title, company, url, salary, info 
        from ".$this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function create(){
        $query = "insert into".$this->table_name."set name=:name, lang=:lang, title=:title, company=:company, url=:url, salary=:salary, info=:info";
        $stmt = $this->conn->prepare($query);
         
    }   
    
}