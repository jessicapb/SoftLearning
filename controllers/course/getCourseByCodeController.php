<?php

//Enllaços
include_once '../../persistence/MysqlCoursesAdapter.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$codi = filter_input(INPUT_POST, "codi");

//Connectar amb la BD
$seleccionar = new MysqlCoursesAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($codi == null) {
    print "Has d'introduir dades<br>";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($codi) == " ") {
    print "Has d'introduir textos sense espais";
    
//Presenta les dades del formulari 
} else {
    print "El llibre amb el número $codi té les següents dades: <br>";
    try {
        $c = $seleccionar->getCourse($codi);
        print "Codi: ". $c->getCode() .','. " Preu: " . $c->getPrice() .','. " Descripció: " . $c->getDescription() . ',' . 
                " Hores: " . $c->getHours() .',' . " Departament: " . $c->getDepartment();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}

//Torna a la vista
print "  <p><a href=\"../../views/course/seleccionarcourse.html\">Tornar a la pàgina anterior</a></p>\n";