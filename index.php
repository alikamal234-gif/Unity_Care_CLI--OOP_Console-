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
                echo "mamr7bax biiiik";
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
            echo "ajouter est successful 👀";
            $this->MenuPrincipal();
            break;
        case 2:
            echo "mamr7bax biiiik";
            break;
        case 3:
            echo "name : \n";
            $name = trim(fgets(STDIN));
            echo "\nlocation : ";
            $location = trim(fgets(STDIN));
            $department = new departement($name, $location);
            $department->setDepartement();
            break;

    }
}
    public function AfficheMenu()
{
    echo "========== Menu ====================\n";
    echo "1. affiche un patient \n";
    echo "2. affiche un medeciant \n";
    echo "3. affiche un departement \n";
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
            $this->supprimeMenu();
            break;
        case 5:
            echo "mamr7bax biiiik";
            break;

    }
}


function modifieMenu()
{
    system('cls');
    echo "========== Menu ====================\n";
    echo "1. modifie un patient \n";
    echo "2. modifie un medeciant \n";
    echo "3. modifie un departement \n";

    $choicemodifie = trim(fgets(STDIN));
    switch ($choicemodifie) {
        case 1:
            echo "mamr7bax biiiik";
            break;
        case 2:
            echo "mamr7bax biiiik";
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
            break;

    }
}


    function supprimeMenu()
{
    system('cls');
    echo "========== Menu ====================\n";
    echo "1. supprime un patient \n";
    echo "2. supprime un medeciant \n";
    echo "3. supprime un departement \n";

    $choicesupprime = trim(fgets(STDIN));
    switch ($choicesupprime) {
        case 1:
            echo "mamr7bax biiiik";
            break;
        case 2:
            echo "mamr7bax biiiik";
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
            break;
    }
}

}

$menu = new Menu();
$menu->MenuPrincipal();


