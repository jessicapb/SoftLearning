<?php

//Enllaços
//include_once '../model/Stakeholders/ClientCompany.php';
//include_once '../model/Stakeholders/BuildException.php';
//include_once '../model/Stakeholders/Stakeholder.php';
//include_once '../exceptions/checkdata/Checker1.php';
include_once '../../persistence/MysqlClientCompanyAdapter.php';

//Connectar amb la vista
$nom = filter_input(INPUT_POST, "nom");
$cognoms = filter_input(INPUT_POST, "cognoms");
$email = filter_input(INPUT_POST, "email");
$telefon = filter_input(INPUT_POST, "telefon");
$adreca = filter_input(INPUT_POST, "adreca");
$antiguitat = filter_input(INPUT_POST, "antiguitat");
$empresa = filter_input(INPUT_POST, "empresa");
$pagament = filter_input(INPUT_POST, "pagament");
$treballadors = filter_input(INPUT_POST, "treballadors");
$tipus = filter_input(INPUT_POST, "tipus");

//Connectar amb la BD
$actualitzar = new MysqlClientCompanyAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($nom == null or $cognoms == null or $email == null or $telefon == null or $adreca == null or $antiguitat == null or $empresa == null
        or $pagament == null or $treballadors == null or $tipus == null) {
    print "Has d'introduir dades<br>";

//Comprova números en l'input de text
} elseif ($nom == is_numeric($nom) or $cognoms == is_numeric($cognoms) or $adreca == is_numeric($adreca) or $pagament == is_numeric($pagament) or
        $tipus == is_numeric($tipus)) {
    print "Has d'introduir text en els camps nom, cognom, adreça i entitat.";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($nom) == " " or trim($cognoms) == " " or trim($email) == " " or trim($telefon) == " " or trim($adreca) == " "
        or trim($antiguitat) == " " or trim($empresa) == " " or trim($pagament) == " " or trim($treballadors) == " " or trim($tipus) == " ") {
    print "Has d'introduir textos sense espais";

//Presenta les dades del formulari
} else {
    try {
        $cc = $actualitzar->authentication($empresa);
        $clientcompany1 = new ClientCompany($nom, $cognoms, $email, $telefon, $adreca, $antiguitat, $empresa, $pagament, $treballadors, $tipus);
        if ($cc->setNumber($telefon) == 0 and $cc->setEmail($email) == 0 and $cc->setAddress($adreca) == 0 and $cc->setPaymentcode($pagament) == 0) {
            $actualitzar->updateClientCompany($cc);
            print "Dades modificades correctament";
        }else{
            print "Error al modificar les dades";
        }

//Informa error en l'input
    } catch (BuildException $ex) {
        print $ex->getMessage();
    }catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}

//Torna a la vista
print " <p><a href=\"../../views/clientCompany/actualitzaclientCompany.html\">Tornar a la pàgina anterior</a></p>\n";

