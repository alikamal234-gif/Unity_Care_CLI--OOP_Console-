<?php


require 'src/config.php';
require 'src/creud.php';
require "src/statistique.php";



echo "========== Menu ====================\n";
echo "1. L'ajoute \n";
echo "2. L'affichage \n";
echo "3. Modifucation \n";
echo "4. La supprission \n";
echo "5. Statistique \n";

$choice = trim(fgets(STDIN));
switch ($choice) {
    case 1:
        AjouteMenu();
        break;
    case 2:
        AfficheMenu();
        break;
    case 3:
        modifieMenu();
        break;
    case 4:
        supprimeMenu();
        break;
    case 5:
        echo "mamr7bax biiiik";
        break;
    case 6:
        exit;

}

function AjouteMenu()
{
    system('cls');
    echo "========== Menu ====================\n";
    echo "1. ajoute un patient \n";
    echo "2. ajoute un medeciant \n";
    echo "3. ajoute un departement \n";
    $choiceAjoute = trim(fgets(STDIN));
    switch ($choiceAjoute) {
        case 1:
            echo "mamr7bax biiiik";
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

function AfficheMenu()
{
    echo "========== Menu ====================\n";
    echo "1. affiche un patient \n";
    echo "2. affiche un medeciant \n";
    echo "3. affiche un departement \n";
    $choiceAffiche = trim(fgets(STDIN));

    switch ($choiceAffiche) {
        case 1:
            echo "mamr7bax biiiik";
            break;
        case 2:
            echo "mamr7bax biiiik";
            break;
        case 3:
            $departementss = new departement("ali", "youcode");
            print_r($departementss->getDepartement());
            break;
        case 4:
            supprimeMenu();
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
            
            if($modufier == 1){
                $modofierChose = "department_name";
            }elseif($modofierChose == "location"){
                $modofierChose = "location";
            }
            echo "change By : \n";
            $change = trim(fgets(STDIN));
            $department = new departement();
            $department->ModifierDepartement($id,$modofierChose,$change);
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

    
}