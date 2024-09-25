<?php

//Enllaços
include_once '../../persistence/MysqlCoursesAdapter.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$codi = filter_input(INPUT_POST, "codi");

//Connectar amb la BD
$eliminar = new MysqlCoursesAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($codi == null) {
    print "Has d'introduir dades<br>";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($codi) == " ") {
    print "Has d'introduir textos sense espais";
} else {
    try {
        if($eliminar->exists($codi) === false) {
            print "El llibre amb el codi de $codi no existeix.";
        } else {
            $c = $eliminar->deleteCourse($codi);
            print "El llibre amb el codi $codi s'ha eliminat";
        }
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}
//Presenta les dades del formulari 
//Torna a la vista
print "  <p><a href=\"../../views/course/eliminarcourse.html\">Tornar a la pàgina anterior</a></p>\n";
