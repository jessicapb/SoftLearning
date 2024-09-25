<?php

//Enllaç
include_once '../../persistence/MysqlBookAdapter.php';
include_once '../../model/Products/Books.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$code = filter_input(INPUT_POST, "codi");

//Connectar amb la BD
$eliminar = new MysqlBookAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($code == null) {
    print "Has d'introduir dades<br>";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($code) == " ") {
    print "Has d'introduir textos sense espais";
} else {
    try {
        if($eliminar->exists($code) === false) {
            print "El llibre amb el codi $code no existeix.";
        } else {
            $c = $eliminar->deleteBook($code);
            print "El llibre amb el codi $code s'ha eliminat";
        }
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}
//Presenta les dades del formulari 
//Torna a la vista
print "  <p><a href=\"../../views/book/eliminarbook.html\">Tornar a la pàgina anterior</a></p>\n";
