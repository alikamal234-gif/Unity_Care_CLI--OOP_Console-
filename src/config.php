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

class departement extends database
{
    public $DepartementName;
    public $location;

    public function __construct($deparname=null, $location=null)
    {
        parent::__construct();
        $this->DepartementName = $deparname;
        $this->location = $location;
    }
    public function getDepartement()
    {
        return $this->conn->query("SELECT * FROM departments ;")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setDepartement()
    {
        $DepartementName = $this->DepartementName;
        $location = $this->location;
        try {
            $stm = $this->conn->prepare("INSERT INTO departments(department_name,location) VALUES (:department_name , :location);");
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
            $stm = $this->conn->prepare("UPDATE departments SET $choix=:change WHERE id_department =:id");
        $stm->bindParam('change',$change);
        $stm->bindParam('id',$id);
        $stm->execute();
        }catch(Exception $e){
            echo "modufication failed try again !!";
        }
    }
    public function getDepartementId($id)
    {
        return $this->conn->query("SELECT * FROM departments WHERE id_department =$id;")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function supprimeDepartment($id){
        $stm = $this->conn->prepare("DELETE FROM `departments` WHERE id_department = :id");
        $stm->bindParam('id',$id);
        $stm->execute();
    }
}




