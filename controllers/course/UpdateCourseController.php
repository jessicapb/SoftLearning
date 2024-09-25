<?php

//Enllaços
include_once '../../persistence/MysqlCoursesAdapter.php';
include_once '../../exceptions/BuildException.php';

//Connectar amb la vista
$codi = filter_input(INPUT_POST, "codi");
$preu = filter_input(INPUT_POST, "preu");
$descripció = filter_input(INPUT_POST, "descripció");
$hores = filter_input(INPUT_POST, "hores");
$departament = filter_input(INPUT_POST, "departament");

//Connectar amb la BD
$actualitzar = new MysqlCoursesAdapter();

//Presentació dades + Presentació erros
//Comprova dades en l'input
if ($codi == null or $preu == null or $descripció == null or $hores == null or $departament == null) {
    print "Has d'introduir dades<br>";

//Comprova números en l'input de text
} elseif ($descripció == is_numeric($descripció) or $departament == is_numeric($departament)) {
    print "Has d'introduir text en els camps descripció i departament. ";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($codi) == " " or trim($preu) == "" or trim($descripció) == "" or trim($hores) == "" or trim($departament) == "") {
    print "Has d'introduir textos sense espais";

//Presenta les dades del formulari
} else {
    try {
        $c = $actualitzar->authentication($codi);
        $courses1 = new Courses($codi, $preu, $descripció, $hores, $departament);
        if ($c->setPrice($preu) ==0 and $c->setHours($hores) ==0) {
            $actualitzar->updateCourse($c);
            print "Dades modificades correctament";
        } else {
            print "Error al modificar les dades";
        }
//Informa error en l'input
    } catch (BuildException $ex) {
        print $ex->getMessage();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}

//Torna a la vista
print "  <p><a href=\"../../views/course/actualizacourses.html\">Tornar a la pàgina anterior</a></p>\n";

