<?php

//Enllaç
include_once '../../persistence/MysqlClientCompanyAdapter.php';
include_once '../../model/Stakeholders/ClientCompany.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$ident = filter_input(INPUT_POST, "ident");

//Connectar amb la BD
$seleccionar = new MysqlClientCompanyAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($ident == null) {
    print "Has d'introduir dades<br>";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($ident) == " ") {
    print "Has d'introduir textos sense espais";
} else {
    print "El client amb el número $ident té les següents dades: <br>";
    try {
        $cc = $seleccionar->getClientCompany($ident);
        print "Nom: " . $cc->getName() . ',' . " Cognoms: " . $cc->getSurname() . ',' . " Email: " . $cc->getEmail() . ', '
                . " Telefon: " . $cc->getNumber() . ',' . " Adreça: " . $cc->getAddress() . ',' . " Antiguitat: " . $cc->getAntiquity() . ',' .
                "Número de l'empresa: " . $cc->getIdent() . ',' .  " Metode de pagament: " . $cc->getPaymentcode() . ',' . 
                " Treballadors: " . $cc->getWorkers() . ',' .  " Tipus d'empresa: " . $cc->getSocialreason();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}
//Presenta les dades del formulari 
//Torna a la vista
print "  <p><a href=\"../../views/clientCompany/seleccionarclientCompany.html\">Tornar a la pàgina anterior</a></p>\n";