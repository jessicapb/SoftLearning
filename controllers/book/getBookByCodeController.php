<?php

//Enllaç
include_once '../../persistence/MysqlBookAdapter.php';
include_once '../../model/Products/Books.php';
include_once '../../exceptions/ServiceException.php';

//Connectar amb la vista
$codi = filter_input(INPUT_POST, "codi");

//Connectar amb la BD
$seleccionar = new MysqlBookAdapter();

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
        $b = $seleccionar->getBook($codi);
        print "Codi: ".  $b->getCode(). ','.   " Preu: ". $b->getPrice(). ',' . " Descripcio" . ','.  " Autor:" . $b->getAuthor() . ',' . 
                " Titol:" . $b->getTitle() . ',' . " Tapa:" . $b->getCover() . ',' . " Pàgines: " . $b->getPage() . ',' . " Gènere: " .$b->getGender() .
                ','. " Editorial" . $b->getEditorial(). ',' . " ISBN: " .$b->getISBN() . ',' . " Altura: " . $b->getHigh() . ',' . 
                " Amplada: ". $b->getWidth() . ',' . " Longitud: " . $b->getLength() . ',' . " Pes:" . $b->getWeight();
    } catch (ServiceException $ex) {
        echo "Service Error: " . $ex->getMessage();
    }
}

//Torna a la vista
print "  <p><a href=\"../../views/book/seleccionarllibre.html\">Tornar a la pàgina anterior</a></p>\n";
