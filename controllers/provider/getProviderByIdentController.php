<?php

//Enllaç
include_once '../../persistence/MysqlProviderAdapter.php';
include_once '../../model/Stakeholders/Provider.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$ident = filter_input(INPUT_POST, "ident");

//Connectar amb la BD
$seleccionar = new MysqlProviderAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($ident == null) {
    print "Has d'introduir dades<br>";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($ident) == " ") {
    print "Has d'introduir textos sense espais";
} else {
    print "El proveïdor amb el número $ident té les següents dades: <br>";
    try {
        $p = $seleccionar->getProvider($ident);
        print "Nom: " . $p->getName() . ',' . " Cognoms: " . $p->getSurname() . ',' . " Email: " . $p->getEmail() . ', '
                . " Telefon: " . $p->getNumber() . ',' . " Adreça: " . $p->getAddress() . ',' . " Antiguitat: " . $p->getAntiquity() . ',' .
                " Número de proveïdor: " . $p->getIdent() . ',' . " Empresa on treballa: " . $p->getSponsors() . ',' . 
                " Treballadors: " . $p->getWorkers() . ',' . " Tipus d'empresa:  " . $p->getSocialreason();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}
//Presenta les dades del formulari 
//Torna a la vista
print "  <p><a href=\"../../views/provider/seleccionarprovider.html\">Tornar a la pàgina anterior</a></p>\n";

