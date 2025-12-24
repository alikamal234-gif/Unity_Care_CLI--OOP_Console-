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
    
}

function AfficheMenu()
{
}

function modifieMenu()
{
    
}

function supprimeMenu()
{
    
    
}