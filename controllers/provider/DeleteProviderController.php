<?php

//Enllaç
include_once '../../persistence/MysqlProviderAdapter.php';
include_once '../../model/Stakeholders/Provider.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$ident = filter_input(INPUT_POST, "ident");

//Connectar amb la BD
$eliminar = new MysqlProviderAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($ident == null) {
    print "Has d'introduir dades<br>";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($ident) == " ") {
    print "Has d'introduir textos sense espais";
} else {
    try {
        if ($eliminar->exists($ident) === false) {
            print "El proveïdor amb el número $ident no existeix.";
        } else {
            $c = $eliminar->deleteProvider($ident);
            print "El proveïdor amb el número $ident s'ha eliminat";
        }
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}
//Presenta les dades del formulari 
//Torna a la vista
print "  <p><a href=\"../../views/provider/eliminarprovider.html\">Tornar a la pàgina anterior</a></p>\n";
