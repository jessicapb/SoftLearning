<?php

//Enllaços
include_once '../../model/Stakeholders/BuildException.php';
//include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/persistence/MysqlAdapter.php');
//include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/exceptions/checkdata/Checker1.php');
include_once '../../persistence/MysqlClientAdapter.php';

//Connectar amb la vista
$nom = filter_input(INPUT_POST, "nom");
$cognoms = filter_input(INPUT_POST, "cognoms");
$email = filter_input(INPUT_POST, "email");
$telefon = filter_input(INPUT_POST, "telefon");
$adreca = filter_input(INPUT_POST, "adreca");
$aniversari = filter_input(INPUT_POST, "aniversari");
$soci = filter_input(INPUT_POST, "soci");
$pagament = filter_input(INPUT_POST, "pagament");

//Connectar amb la BD
$afegir = new MysqlClientAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($nom == null or $cognoms == null or $email == null or $telefon == null or $adreca == null or $aniversari == null or $soci == null
        or $pagament == null) {
    print "Has d'introduir dades<br>";

//Comprova números en l'input de text    
} elseif ($nom == is_numeric($nom) or $cognoms == is_numeric($cognoms) or $adreca == is_numeric($adreca) or $pagament == is_numeric($pagament)) {
    print "Has d'introduir text en els camps nom, cognom, adreça i mètode de pagament. ";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($nom) == " " or trim($cognoms) == " " or trim($email) == " " or trim($telefon) == " " or trim($adreca) == " "
        or trim($aniversari) == " " or trim($soci) == " " or trim($pagament) == " ") {
    print "Has d'introduir textos sense espais";

//Presenta les dades del formulari 
} else {
    try {
        if ($afegir->exists($soci) === false) {
            $client1 = new Client($nom, $cognoms, $email, $telefon, $adreca, $aniversari, $soci, $pagament);
            $afegir->addClient($client1);
            echo "S'han introduït les dades correctament a la base de dades.";
        }else{
            print "El client amb el número de $soci ja existeix.";
        }
    } catch (BuildException $ex) {
        echo "Build Error: " . $ex->getMessage();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}

//Torna a la vista
print "  <p><a href=\"../../views/client/client.html\">Tornar a la pàgina anterior</a></p>\n";
