<?php

//Enllaços
//include_once '../model/Stakeholders/Provider.php';
//include_once '../model/Stakeholders/BuildException.php';
//include_once '../model/Stakeholders/Stakeholder.php';
//include_once '../exceptions/checkdata/Checker1.php';
include_once '../../persistence/MysqlProviderAdapter.php';

//Connectar amb la vista
$nom = filter_input(INPUT_POST, "nom");
$cognoms = filter_input(INPUT_POST, "cognoms");
$email = filter_input(INPUT_POST, "email");
$telefon = filter_input(INPUT_POST, "telefon");
$adreca = filter_input(INPUT_POST, "adreca");
$antiguitat = filter_input(INPUT_POST, "antiguitat");
$proveidor = filter_input(INPUT_POST, "proveidor");
$treballa = filter_input(INPUT_POST, "treballa");
$treballadors = filter_input(INPUT_POST, "treballadors");
$tipus = filter_input(INPUT_POST, "tipus");

//Connectar amb la BD
$afegir = new MysqlProviderAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($nom == null or $cognoms == null or $email == null or $telefon == null or $adreca == null or $antiguitat == null or $proveidor == null
        or $treballa == null or $treballadors == null or $tipus == null) {
    print "Has d'introduir dades<br>";

//Comprova números en l'input de text
} elseif ($nom == is_numeric($nom) or $cognoms == is_numeric($cognoms) or $adreca == is_numeric($adreca) or $treballa == is_numeric($treballa)
        or $tipus == is_numeric($tipus)) {
    print "Has d'introduir text en els camps nom, cognom, adreça,empresa on treballa i tipus d'empresa. ";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($nom) == " " or trim($cognoms) == " " or trim($email) == " " or trim($telefon) == " " or trim($adreca) == " "
        or trim($antiguitat) == " " or trim($proveidor) == " " or trim($treballa) == " " or trim($treballadors) == " " or trim($tipus) == " ") {
    print "Has d'introduir textos sense espais";

//Presenta les dades del formulari
} else {
    try {
        if ($afegir->exists($proveidor) === false) {
            $provider1 = new Provider($nom, $cognoms, $email, $telefon, $adreca, $antiguitat, $proveidor, $treballa, $treballadors, $tipus);
            $afegir->addProvider($provider1);
            echo "S'han introduït les dades correctament a la base de dades.";
            print "<br>";
            //Company Data
            print "Company Data: " . "Treballadors: " . $provider1->getWorkers() . " (" . $provider1->getCompanyType() . ")"
                    . ", Tipus d'empresa: " . $provider1->getSocialreason();
        } else {
            print "El proveïdor amb el número $proveidor ja existeix.";
        }

//Informa error en l'input
    } catch (BuildException $ex) {
        print $ex->getMessage();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}

//Torna a la vista
print "  <p><a href=\"../../views/provider/provider.html\">Tornar a la pàgina anterior</a></p>\n";
