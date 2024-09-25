<?php

//Enllaç
include_once '../../persistence/MysqlClientAdapter.php';
include_once '../../model/Stakeholders/Client.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$ident = filter_input(INPUT_POST, "ident");

//Connectar amb la BD
$seleccionar = new MysqlClientAdapter();

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
        $c = $seleccionar->getClient($ident);
        print "Nom: " . $c->getName() . ',' . " Cognoms: " . $c->getSurname() . ',' . " Email: " . $c->getEmail() . ', '
                . " Telefon: " . $c->getNumber() . ',' . " Adreça: " . $c->getAddress() . ',' . " Aniversari: " . $c->getAntiquity() . ',' .
                "Número de soci: " . $c->getIdent() . ',' .  " Metode de pagament: " . $c->getPaymentcode();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}
//Presenta les dades del formulari 
//Torna a la vista
print "  <p><a href=\"../../views/client/seleccionarclient.html\">Tornar a la pàgina anterior</a></p>\n";
