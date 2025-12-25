<?php

class database
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'hospital';
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "connect was failed !! : " . $e->getMessage();
        }
    }
}


class person
{
    public $FirstName;
    public $LastName;
    public $email;
    public $PhoneNumber;

    public $conection;

    public function __construct($FirstName=null,$LastName=null,$email=null,$PhoneNumber=null) {
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->email = $email;
        $this->PhoneNumber = $PhoneNumber;
    }

    public function GetPerson($tableName){
        $this->conection =  new database();
        return $this->conection->conn->query("SELECT * FROM $tableName ;")->fetchAll(PDO::FETCH_ASSOC);
    }



}

class patient extends person
{
    public $gender;
    public $DateOfBirth;
    public $adress;
}

class doctor extends person
{
    public $specialization;
    public $IdDepartement;
}

class departement
{
    public $DepartementName;
    public $location;
    public $conection;
    


    public function __construct($deparname=null, $location=null)
    {
        
        $this->DepartementName = $deparname;
        $this->location = $location;
    }
    public function getDepartement()
    {
        $this->conection =  new database();
        return $this->conection->conn->query("SELECT * FROM departments ;")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setDepartement()
    {
        $this->conection =  new database();
        $DepartementName = $this->DepartementName;
        $location = $this->location;
        try {
            $stm = $this->conection->conn->prepare("INSERT INTO departments(department_name,location) VALUES (:department_name , :location);");
            $stm->bindParam("department_name", $DepartementName);
            $stm->bindParam("location", $location);
            $stm->execute();

            echo "l'ajoute est successfull";
        }catch(Exception $e){
            echo "try again ...";
        }
    }

    public function ModifierDepartement($id,$choix,$change){
        try{
            $this->conection =  new database();
            $stm = $this->conection->conn->prepare("UPDATE departments SET $choix=:change WHERE id_department =:id");
        $stm->bindParam('change',$change);
        $stm->bindParam('id',$id);
        $stm->execute();
        }catch(Exception $e){
            echo "modufication failed try again !!";
        }
    }
    public function getDepartementId($id)
    {
        $this->conection =  new database();
        return $this->conection->conn->query("SELECT * FROM departments WHERE id_department =$id;")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function supprimeDepartment($id){
        $this->conection =  new database();
        $stm = $this->conection->conn->prepare("DELETE FROM `departments` WHERE id_department = :id");
        $stm->bindParam('id',$id);
        $stm->execute();
    }
}



