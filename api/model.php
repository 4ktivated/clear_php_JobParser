<?php

class VacModel
{   
    private $conn;
    private $table_name = 'public.vacs';


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
        id, lang, title, company, url, salary, info 
        from ".$this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function create(){
        $query = "insert into".$this->table_name."set,
         lang=:lang, 
         title=:title, 
         company=:company, 
         url=:url, 
         salary=:salary, 
         info=:info";

        $stmt = $this->conn->prepare($query);

        $this->lang=htmlspecialchars(strip_tags($this->lang));
        $this->title=htmlspecialchars(strip_tags($this->title));
        $this->company=htmlspecialchars(strip_tags($this->company));
        $this->url=htmlspecialchars(strip_tags($this->url));
        $this->salary=htmlspecialchars(strip_tags($this->salary));
        $this->info=htmlspecialchars(strip_tags($this->info));

        $stmt->bindParam(":lang", $this->lang);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":company", $this->company);
        $stmt->bindParam(":url", $this->url);
        $stmt->bindParam(":salary", $this->salary);
        $stmt->bindParam(":info", $this->info);
        if($stmt->execute()){
            return true;
        }

        return false;
    }   
#удаляем все данные потому что залоиваться они будут большим скопом и пока нет возможности проверять актуальность вакансии 
    public function delete()
    {
        $query = "delete from ".$this->table_name;
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
 
    public function search($keywords)
    {
        $query = "select from ".$this->table_name." where lang like ?";
        $stmt = $this->conn->prepare($query);
        $keywords = htmlspecialchars(strip_tags($keywords));
        $keywords = "%{$keywords}%";
        $stmt->bindParam(1, $keywords);
        $stmt->execute();
        return $stmt;
    }   

    public function readPaging($from_record_num, $records_per_page)
    {   
        $query = "select * from ".$this->table_name." order by id desc limit ?, ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt;
    }
    public function count()
    {
        $query = "select count(*) as total_rows from ".$this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total_rows'];
    }
}

