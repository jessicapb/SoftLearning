<?php

//Enllaç
include_once '../../persistence/MysqlBookAdapter.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$codi = filter_input(INPUT_POST, "codi");
$preu = filter_input(INPUT_POST, "preu");
$descripció = filter_input(INPUT_POST, "descripció");
$autor = filter_input(INPUT_POST, "autor");
$titol = filter_input(INPUT_POST, "titol");
$tapa = filter_input(INPUT_POST, "tapa");
$pagines = filter_input(INPUT_POST, "pagines");
$genere = filter_input(INPUT_POST, "genere");
$editorial = filter_input(INPUT_POST, "editorial");
$isbn = filter_input(INPUT_POST, "isbn");
$altura = filter_input(INPUT_POST, "altura");
$amplada = filter_input(INPUT_POST, "amplada");
$longitud = filter_input(INPUT_POST, "longitud");
$pes = filter_input(INPUT_POST, "pes");
$volum = "";

//Connectar amb la BD
$actualitzar = new MysqlBookAdapter();

//Presentació dades + Presentació errors
//Comprova dades en l'input
if ($codi == null or $preu == null or $descripció == null or $autor == null or
        $titol == null or $tapa == null or $pagines == null or $genere == null or $editorial == null or $isbn == null
        or $altura == null or $amplada == null or $longitud == null or $pes == null) {
    print "Has d'introduir dades<br>";

//Comprova números en l'input de text
} elseif ($descripció == is_numeric($descripció) or $autor == is_numeric($autor) or $titol == is_numeric($titol)
        or $tapa == is_numeric($tapa) or $genere == is_numeric($genere) or $editorial == is_numeric($editorial)) {
    print "Has d'introduir text en els camps descripció, autor, títol, tapa, gènere i editorial. ";

//Comprova els espais en blanc al principi de l'input
} elseif (trim($codi) == " " or trim($preu) == " " or trim($descripció) == " " or trim($autor) == " " or trim($titol) == " "
        or trim($tapa) == " " or trim($pagines) == " " or trim($genere) == " " or trim($editorial) == " " or trim($isbn) == " "
        or trim($altura) == " " or trim($amplada) == " " or trim($longitud) == " " or trim($pes) == " ") {
    print "Has d'introduir textos sense espais";

//Presenta les dades del formulari
} else {
    try {
        $b = $actualitzar->authentication($codi);
        $book1 = new Books($codi, $preu, $descripció, $autor, $titol, $tapa, $pagines, $genere, $editorial, $isbn, $altura,
                $amplada, $longitud, $pes);
        if ($b->setPrice($preu) == 0) {
            $actualitzar->updateBook($b);
            print "Dades modificades correctament";
        } else {
            print "Error en modificar el preu.";
        }
//Informa error en l'input
    } catch (BuildException $ex) {
        print $ex->getMessage();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}
//Torna a la vista
print "  <p><a href=\"../../views/book/actualitzarbook.html\">Tornar a la pàgina anterior</a></p>\n";

