<?php


require 'src/config.php';
require 'src/creud.php';
require "src/statistique.php";


class Menu
{
    public function MenuPrincipal()
    {
        echo "========== Menu ====================\n";
        echo "1. L'ajoute \n";
        echo "2. L'affichage \n";
        echo "3. Modifucation \n";
        echo "4. La supprission \n";
        echo "5. Statistique \n";
        echo "6. Exit \n";

        $choice = trim(fgets(STDIN));
        switch ($choice) {
            case 1:
                $this->AjouteMenu();
                break;
            case 2:
                $this->AfficheMenu();
                break;
            case 3:
                $this->modifieMenu();
                break;
            case 4:
                $this->supprimeMenu();
                break;
            case 5:
                $this->statistique();
                break;
            case 6:
                exit;

        }

    }

    public function AjouteMenu()
    {
        echo "========== Menu ====================\n";
        echo "1. ajoute un patient \n";
        echo "2. ajoute un medeciant \n";
        echo "3. ajoute un departement \n";
        $choiceAjoute = trim(fgets(STDIN));
        switch ($choiceAjoute) {
            case 1:
                echo "First name : \n";
                $firstName = trim(fgets(STDIN));
                echo "Last name : \n";
                $LastName = trim(fgets(STDIN));
                echo "Email : \n";
                $email = trim(fgets(STDIN));
                echo "Phone Number : \n";
                $phone = trim(fgets(STDIN));
                echo "Gender : \n";
                $gender = trim(fgets(STDIN));
                echo "Date Of bithday : \n";
                $birdth = trim(fgets(STDIN));
                echo "Adress : \n";
                $adress = trim(fgets(STDIN));
                $patient = new patient($firstName, $LastName, $email, $phone, $gender, $birdth, $adress);
                $patient->SetPerson();
                $this->MenuPrincipal();
                break;
            case 2:
                echo "First name : \n";
                $firstName = trim(fgets(STDIN));
                echo "Last name : \n";
                $LastName = trim(fgets(STDIN));
                echo "Email : \n";
                $email = trim(fgets(STDIN));
                echo "Phone Number : \n";
                $phone = trim(fgets(STDIN));
                echo "Specialization : \n";
                $specialization = trim(fgets(STDIN));
                echo "id_department : \n";
                $id_department = trim(fgets(STDIN));
                $doctor = new doctor($firstName, $LastName, $email, $phone,$specialization,(int)$id_department);
                $doctor->SetPerson();
                $this->MenuPrincipal();
                break;
            case 3:
                echo "name : \n";
                $name = trim(fgets(STDIN));
                echo "\nlocation : ";
                $location = trim(fgets(STDIN));
                $department = new departement($name, $location);
                $department->setDepartement();
                $this->MenuPrincipal();
                break;
        }
    }
    public function AfficheMenu()
    {
        echo "========== Menu ====================\n";
        echo "1. affiche un patient \n";
        echo "2. affiche un medeciant \n";
        echo "3. affiche un departement \n";
        echo "3. Exit \n";
        $choiceAffiche = trim(fgets(STDIN));
        switch ($choiceAffiche) {
            case 1:
                $patients = new patient();
                print_r($patients->GetPerson('patients'));
                $this->MenuPrincipal();
                break;
            case 2:
                $doctor = new doctor();
                print_r($doctor->GetPerson('departments'));
                $this->MenuPrincipal();
                break;
            case 3:
                $departementss = new departement("ali", "youcode");
                print_r($departementss->getDepartement());
                $this->MenuPrincipal();
                break;
            case 4:
                echo "Exit";
                break;

        }
    }


    function modifieMenu()
    {
        echo "========== Menu ====================\n";
        echo "1. modifie un patient \n";
        echo "2. modifie un medeciant \n";
        echo "3. modifie un departement \n";

        $choicemodifie = trim(fgets(STDIN));
        switch ($choicemodifie) {
            case 1:
                echo "ID ( patient ) : \n";
                $id = trim(fgets(STDIN));
                echo "Que veux-tu modufier ?\n
                1.first name\n2.last name\n
                3.gender\n4.email\n
                5.date of birthday\n6.phone number\n
                7.address\n";
                $modufier = trim(fgets(STDIN));
                $modofierChose = null;

                switch((int)$modufier){
                    case 1:
                        $modofierChose = "first_name";
                        break;
                    case 2:
                        $modofierChose = "last_name";
                        break;
                    case 3:
                        $modofierChose = "gender";
                        break;
                    case 4:
                        $modofierChose = "email";
                        break;
                    case 5:
                        $modofierChose = "date_of_bidth";
                        break;
                    case 6:
                        $modofierChose = "phone_number";
                        break;
                    case 7:
                        $modofierChose = "address";
                        break;
                }
                 echo "change By : \n";
                $change = trim(fgets(STDIN));
                $patient = new Person();
                $patient->ModifierPersont("patients",$id,"id_patient",$modofierChose,$change);
                        
                $this->MenuPrincipal();
                break;
            case 2:
                echo "ID ( patient ) : \n";
                $id = trim(fgets(STDIN));
                echo "Que veux-tu modufier ?\n
                1.first name\n2.last name\n
                3.specialization\n4.email\n
                \n5.phone number\n6.address\n";
                $modufier = trim(fgets(STDIN));
                $modofierChose = null;

                switch((int)$modufier){
                    case 1:
                        $modofierChose = "first_name";
                        break;
                    case 2:
                        $modofierChose = "last_name";
                        break;
                    case 3:
                        $modofierChose = "specialization";
                        break;
                    case 4:
                        $modofierChose = "email";
                        break;
                    case 5:
                        $modofierChose = "phone_number";
                        break;
                    case 6:
                        $modofierChose = "id_department";
                        break;
                }
                 echo "change By : \n";
                $change = trim(fgets(STDIN));
                $patient = new Person();
                $patient->ModifierPersont("doctors",$id,"id_doctor",$modofierChose,$change);
                        
                $this->MenuPrincipal();
                break;
            case 3:
                echo "ID ( departement ) : \n";
                $id = trim(fgets(STDIN));
                echo "Que veux-tu modufier ?\n1.name\n2.location\n";
                $modufier = trim(fgets(STDIN));
                $modofierChose = null;

                if ($modufier == 1) {
                    $modofierChose = "department_name";
                } elseif ($modofierChose == "location") {
                    $modofierChose = "location";
                }
                echo "change By : \n";
                $change = trim(fgets(STDIN));
                $department = new departement();
                $department->ModifierDepartement($id, $modofierChose, $change);
                $this->MenuPrincipal();
                break;

        }
    }


    public function supprimeMenu()
    {
        echo "========== Menu ====================\n";
        echo "1. supprime un patient \n";
        echo "2. supprime un medeciant \n";
        echo "3. supprime un departement \n";

        $choicesupprime = trim(fgets(STDIN));
        switch ($choicesupprime) {
            case 1:
                echo "ID ( patient ) : \n";
                $id = trim(fgets(STDIN));
                $patient = new Person();
                $patient->DeletPerson("patients",(int)$id,"id_patient");
                $this->MenuPrincipal();
                break;

            case 2:
                echo "ID ( departement ) : \n";
                $id = trim(fgets(STDIN));
                $patient = new Person();
                $patient->DeletPerson("doctors",(int)$id,"id_doctor");
                $this->MenuPrincipal();
                break;
            case 3:
                echo "ID ( departement ) : \n";
                $id = trim(fgets(STDIN));
                $department = new departement();
                $name = $department->getDepartementId((int) $id);
                echo "Verifier est-ce-que tu vaux supprime " . $name[0]['department_name'] . " (yes/no) :\n";

                $supprimeChose = trim(fgets(STDIN));

                if (strtoupper($supprimeChose) == "YES") {
                    $department->supprimeDepartment((int) $id);
                } else {
                    echo "okk khod ra7tek ";
                }
                $this->MenuPrincipal();
                break;
        }
    }

    public function statistique(){
        $statistique = new Person(); 
        echo "=========== Total ===========\n";
        echo "Total of patients : " . $statistique->totalePerson("patients") ." \n";
        echo "Total of doctors : " . $statistique->totalePerson("doctors") ." \n";
        echo "Total of departments : " . $statistique->totalePerson("departments") ." \n";
        echo "\n=========== moyen age ===========\n";
        echo "moyen age de patients : " . $statistique->AgeMoyen("patients") ." \n";
        echo "\n=========== grande age ===========\n";
        echo "grande age de patients : ";
        echo "\n=========== petit age ===========\n";
        echo "petit age de patients : ";
        $this->MenuPrincipal();
    }

}

$menu = new Menu();
$menu->MenuPrincipal();


