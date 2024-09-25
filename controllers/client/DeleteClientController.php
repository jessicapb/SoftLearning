<?php

//Enllaç
include_once '../../persistence/MysqlClientAdapter.php';
include_once '../../model/Stakeholders/Client.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$ident = filter_input(INPUT_POST, "ident");

//Connectar amb la BD
$eliminar = new MysqlClientAdapter();

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
            print "El client amb el número $ident no existeix.";
        } else {
            $c = $eliminar->deleteClient($ident);
            print "El client amb el número de soci $ident s'ha eliminat";
        }
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}
//Presenta les dades del formulari 
//Torna a la vista
print "  <p><a href=\"../../views/client/eliminarclient.html\">Tornar a la pàgina anterior</a></p>\n";
