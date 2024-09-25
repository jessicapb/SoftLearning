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
$actualitzar = new MysqlProviderAdapter();

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
        $p = $actualitzar->authentication($proveidor);
        $provider1 = new Provider($nom, $cognoms, $email, $telefon, $adreca, $antiguitat, $proveidor, $treballa, $treballadors, $tipus);
        if ($p->setEmail($email) == 0 and $p->setNumber( $telefon) == 0 and $p->setAddress($adreca) == 0 and $p->setSponsors($treballa) == 0) {
            $actualitzar->updateProvider($p);
            print "Dades modificades correctament";
        }else{
            print "Error al modificar les dades";
        }
//Informa error en l'input
    } catch (BuildException $ex) {
        print $ex->getMessage();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}

//Torna a la vista
print "  <p><a href=\"../../views/provider/actualitzarprovider.html\">Tornar a la pàgina anterior</a></p>\n";


