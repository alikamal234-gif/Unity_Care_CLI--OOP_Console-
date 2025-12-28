<?php

use Dom\ParentNode;

class database
{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $dbname = 'hospital';
    public PDO $conn;

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


class Person
{
    public $FirstName;
    public $LastName;
    public $email;
    public $PhoneNumber;

    public $conection;

    public function __construct($FirstName = null, $LastName = null, $email = null, $PhoneNumber = null)
    {
        $this->FirstName = $FirstName;
        $this->LastName = $LastName;
        $this->email = $email;
        $this->PhoneNumber = $PhoneNumber;
    }

    public function GetPerson($tableName)
    {
        $this->conection = new database();
        return $this->conection->conn->query("SELECT * FROM $tableName ;")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SetPerson($tableName)
    {
        $this->conection = new database();

    }

    public function DeletPerson($table, $id,$columnID)
    {
        $this->conection = new database();
        $sql = "DELETE FROM $table WHERE $columnID= :id";
        $stm = $this->conection->conn->prepare($sql);
        $stm->bindParam('id', $id);
        $stm->execute();
    }


    public function ModifierPersont($table ,$id,$columnID, $choix, $change)
{
    if (
        !Validation::notEmpty($change) ||
        !Validation::number($id)
    ) {
        echo "invalid modification data\n";
        return;
    }

    try {
        $this->conection = new database();
        $stm = $this->conection->conn->prepare(
            "UPDATE $table SET $choix = :change WHERE $columnID = :id"
        );
        $stm->bindParam('change', $change);
        $stm->bindParam('id', $id);
        $stm->execute();

        echo "change est successful 👀";
    } catch (Exception $e) {
        echo "modufication failed\n";
    }
}


    public function totalePerson($table){
        $this->conection = new database();
        return $this->conection->conn->query("SELECT count(*) FROM $table")->fetchColumn();
    }
    public function AgeMoyen($table){
        $this->conection = new database();
        $stm = $this->conection->conn->query("SELECT AVG(TIMESTAMPDIFF(YEAR, `date_of_birth`, CURDATE())) AS age_moyen FROM $table");
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return round($result['age_moyen'], 2);
    }

    public function grandAge($table){
        $sql = "SELECT * FROM $table ORDER BY TIMESTAMPDIFF(YEAR, `date_of_birth`, CURDATE()) DESC LIMIT 1";
        $stm = $this->conection->conn->query($sql);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return "\n\nid : " .$result['id_patient'] ."\nfirst_name : ".$result['first_name'] ."\ndate of birthday : ".  $result['date_of_birth'] . "\n\n";
    }
    public function petitAge($table){
        $sql = "SELECT * FROM $table ORDER BY TIMESTAMPDIFF(YEAR, `date_of_birth`, CURDATE()) ASC LIMIT 1";
        $stm = $this->conection->conn->query($sql);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return "\n\nid : " .$result['id_patient'] ."\nfirst_name : ".$result['first_name'] ."\ndate of birthday : ".  $result['date_of_birth'] . "\n\n";
    }

    public function Validation(){

    }
    
}

class patient extends Person
{
    public $gender;
    public $DateOfBirth;
    public $adress;

    
    public function __construct($FirstName = null, $LastName = null, $email = null, $PhoneNumber = null, $gender = null, $DateOfBirth = null, $adress = null)
    {
        parent::__construct($FirstName, $LastName, $email, $PhoneNumber);
        $this->gender = $gender;
        $this->DateOfBirth = $DateOfBirth;
        $this->adress = $adress;
    }



    public function SetPerson($tableName = 'patients')
{

    if (
        !Validation::name($this->FirstName) ||
        !Validation::name($this->LastName) ||
        !Validation::email($this->email) ||
        !Validation::phone($this->PhoneNumber) ||
        !Validation::gender($this->gender) ||
        !Validation::date($this->DateOfBirth) ||
        !Validation::notEmpty($this->adress)
    ) {
        echo " Invalid patient data\n";
        return;
    }

    try {
        $this->conection = new database();
        $sql = "INSERT INTO $tableName 
        (first_name,last_name,gender,email,date_of_birth,phone_number,address) 
        VALUES ( :first_name, :last_name, :gender, :email, :date_of_birth, :phone_number , :adress);";

        $stm = $this->conection->conn->prepare($sql);
        $stm->bindParam('first_name', $this->FirstName);
        $stm->bindParam('last_name', $this->LastName);
        $stm->bindParam('gender', $this->gender);
        $stm->bindParam('email', $this->email);
        $stm->bindParam('date_of_birth', $this->DateOfBirth);
        $stm->bindParam('phone_number', $this->PhoneNumber);
        $stm->bindParam('adress', $this->adress);
        $stm->execute();

        echo "ajouter est successful 👀\n";
    } catch (Exception $ERROR) {
        echo " error de ajoute\n";
    }
}


    
}

class doctor extends Person
{
    public $specialization;
    public $IdDepartement;

    public function __construct($FirstName = null, $LastName = null, $email = null, $PhoneNumber = null, $specialization = null, $IdDepartement = null)
    {
        parent::__construct($FirstName, $LastName, $email, $PhoneNumber);
        $this->specialization = $specialization;
        $this->IdDepartement = $IdDepartement;
    }


    public function SetPerson($tableName = 'doctors')
{
    if (
        !Validation::name($this->FirstName) ||
        !Validation::name($this->LastName) ||
        !Validation::email($this->email) ||
        !Validation::phone($this->PhoneNumber) ||
        !Validation::notEmpty($this->specialization) ||
        !Validation::number($this->IdDepartement)
    ) {
        echo "invalid data\n";
        return;
    }

    try {
        $this->conection = new database();
        $sql = "INSERT INTO $tableName 
        (first_name,last_name,specialization,phone_number,email,id_department) 
        VALUES ( :first_name, :last_name,:specialization,:phone_number , :email, :id_department);";

        $stm = $this->conection->conn->prepare($sql);
        $stm->bindParam('first_name', $this->FirstName);
        $stm->bindParam('last_name', $this->LastName);
        $stm->bindParam('specialization', $this->specialization);
        $stm->bindParam('phone_number', $this->PhoneNumber);
        $stm->bindParam('email', $this->email);
        $stm->bindParam('id_department', $this->IdDepartement);
        $stm->execute();

        echo "ajouter est successful\n";
    } catch (Exception $error) {
        echo "error de ajoute\n";
    }
}


}

class departement
{
    public $DepartementName;
    public $location;
    public $conection;



    public function __construct($deparname = null, $location = null)
    {

        $this->DepartementName = $deparname;
        $this->location = $location;
    }
    public function getDepartement()
    {
        $this->conection = new database();
        return $this->conection->conn->query("SELECT * FROM departments ;")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function setDepartement()
    {
        $this->conection = new database();
        $DepartementName = $this->DepartementName;
        $location = $this->location;
        try {
            $stm = $this->conection->conn->prepare("INSERT INTO departments(department_name,location) VALUES (:department_name , :location);");
            $stm->bindParam("department_name", $DepartementName);
            $stm->bindParam("location", $location);
            $stm->execute();

            echo "l'ajoute est successfull";
        } catch (Exception $e) {
            echo "try again ...";
        }
    }

    public function ModifierDepartement($id, $choix, $change)
    {
        try {
            $this->conection = new database();
            $stm = $this->conection->conn->prepare("UPDATE departments SET $choix=:change WHERE id_department =:id");
            $stm->bindParam('change', $change);
            $stm->bindParam('id', $id);
            $stm->execute();
        } catch (Exception $e) {
            echo "modufication failed try again !!";
        }
    }
    public function getDepartementId($id)
    {
        $this->conection = new database();
        return $this->conection->conn->query("SELECT * FROM departments WHERE id_department =$id;")->fetchAll(PDO::FETCH_ASSOC);
    }
    public function supprimeDepartment($id)
    {
        $this->conection = new database();
        $stm = $this->conection->conn->prepare("DELETE FROM `departments` WHERE id_department = :id");
        $stm->bindParam('id', $id);
        $stm->execute();
    }
}



class Validation {

    public static function notEmpty($value) {
        return trim($value) !== '';
    }

    public static function name($value) {
        return preg_match('/^[a-zA-Z\s]{2,50}$/', $value);
    }

    public static function email($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function phone($phone) {
        return preg_match('/^[0-9]{10,15}$/', $phone);
    }

    public static function gender($gender) {
        return in_array(strtolower($gender), ['male', 'female']);
    }

    public static function date($date) {
        return (bool) strtotime($date);
    }

    public static function number($value) {
        return is_numeric($value);
    }
}
