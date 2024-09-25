<?php

//Enllaç
include_once '../../persistence/MysqlClientCompanyAdapter.php';
include_once '../../model/Stakeholders/ClientCompany.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$ident = filter_input(INPUT_POST, "ident");

//Connectar amb la BD
$eliminar = new MysqlClientCompanyAdapter();

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
            print "L'empresa client amb el número $ident no existeix.";
        } else {
            $cc = $eliminar->deleteClientCompany($ident);
            print "L'empresa client amb el número d'empresa $ident s'ha eliminat";
        }
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}
//Presenta les dades del formulari 
//Torna a la vista
print "  <p><a href=\"../../views/clientCompany/eliminarclientCompany.html\">Tornar a la pàgina anterior</a></p>\n";


