<?php

//Enllaç
include_once '../../persistence/MysqlEmployeeAdapter.php';
include_once '../../model/Stakeholders/Employee.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$ident = filter_input(INPUT_POST, "ident");

//Connectar amb la BD
$seleccionar = new MysqlEmployeeAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($ident == null) {
    print "Has d'introduir dades<br>";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($ident) == " ") {
    print "Has d'introduir textos sense espais";
} else {
    print "El treballador amb el número $ident té les següents dades: <br>";
    try {
        $e = $seleccionar->getEmployee($ident);
        print "Nom: " . $e->getName() . ',' . " Cognoms: " . $e->getSurname() . ',' . " Email: " . $e->getEmail() . ', '
                . " Telefon: " . $e->getNumber() . ',' . " Adreça: " . $e->getAddress() . ',' . " Antiguitat: " . $e->getAntiquity() . ',' .
                " Número de treballador: " . $e->getIdent() . ',' . " Departament: " . $e->getDepartment() . ',' . 
                " Horari: " . $e->getSchedule() . ',' . " Compte de banc: " . $e->getBankaccount();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}
//Presenta les dades del formulari 
//Torna a la vista
print "  <p><a href=\"../../views/employee/seleccionaremployee.html\">Tornar a la pàgina anterior</a></p>\n";