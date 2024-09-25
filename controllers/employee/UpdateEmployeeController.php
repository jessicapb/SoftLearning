<?php

//Enllaços
//include_once '....//model/Stakeholders/Employee.php';
include_once '../../model/Stakeholders/BuildException.php';
include_once '../../model/Stakeholders/Stakeholder.php';
//include_once '../../exceptions/checkdata/Checker1.php';
include_once '../../persistence/MysqlEmployeeAdapter.php';

//Connectar amb la vista
$nom = filter_input(INPUT_POST, "nom");
$cognoms = filter_input(INPUT_POST, "cognoms");
$email = filter_input(INPUT_POST, "email");
$telefon = filter_input(INPUT_POST, "telefon");
$adreca = filter_input(INPUT_POST, "adreca");
$antiguitat = filter_input(INPUT_POST, "antiguitat");
$treballador = filter_input(INPUT_POST, "treballador");
$departament = filter_input(INPUT_POST, "departament");
$horari = filter_input(INPUT_POST, "horari");
$banc = filter_input(INPUT_POST, "banc");

//Connectar amb la BD
$actualitzar = new MysqlEmployeeAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($nom == null or $cognoms == null or $email == null or $telefon == null or $adreca == null or $antiguitat == null or $treballador == null
        or $departament == null or $horari == null or $banc == null) {
    print "Has d'introduir dades<br>";

//Comprova números en l'input de text
} elseif ($nom == is_numeric($nom) or $cognoms == is_numeric($cognoms) or $adreca == is_numeric($adreca) or $horari == is_numeric($horari)
        or $departament == is_numeric($departament)) {
    print "Has d'introduir text en els camps nom, cognom, adreça i horari.";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($nom) == " " or trim($cognoms) == " " or trim($email) == " " or trim($telefon) == " " or trim($adreca) == " "
        or trim($antiguitat) == " " or trim($treballador) == " " or trim($departament) == " " or trim($horari) == " " or trim($banc) == " ") {
    print "Has d'introduir textos sense espais";

//Presenta les dades del formulari
} else {
    try {
        $e = $actualitzar->authentication($treballador);
        $employee1 = new Employee($nom, $cognoms, $email, $telefon, $adreca, $antiguitat, $treballador, $departament, $horari, $banc);
        if ( $e->setEmail($email) == 0 and $e->setNumber( $telefon) == 0 and $e->setAddress($adreca) == 0 and 
                $e->setDepartment($departament) == 0 and $e->setSchedule($horari) == 0 and $e->setBankaccount($banc) == 0) {
            $actualitzar->updateEmployee($e);
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
print "  <p><a href=\"../../views/employee/actualitzaemployee.html\">Tornar a la pàgina anterior</a></p>\n";
