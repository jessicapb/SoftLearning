<?php

include_once '../../model/Products/Books.php';
include_once '../../model/Products/Courses.php';
include_once '../../model/Products/Marketable.php';
include_once '../../model/Products/Storable.php';
include_once '../../model/Products/operations/Check.php';
include_once '../../model/Products/PhysicalData.php';
include_once '../../exceptions/checkdata/Checker.php';
/* Llibres */
try {
    $book1 = new Books(345678, 45.78, "màgia", "J.K Rowling", "Harry Potter", "Dura", 980, "Fantasia", "Santillana",
            1234567898765, 12.23, 12.21, 12.21, 13, 4.78);

    $error = $book1->setCode(34343433);
    //$error = $book1->setIdClient(1343343);
    $errorreg = $book1->setISBN(1234567891);
    //$errorreg = $book1->setISBN(1234567890987);
    /*$errorreg= $book1->setISBN(1221);*/

    /* ------------------------- */
    print "------LLIBRES / PHYSICALDATA------<br>";

    print $book1->getDetails();
    echo "<br>";
    print "Mesures: " . "Altura: " . $book1->getHigh() . "cm" . ', ' . "Amplada: " . $book1->getWidth() . "cm" . ', ' .
            "Longitud: " . $book1->getLength() . "cm" . ', ' . "Pes: " . $book1->getWeight() . "g" . ', ' . "Volum: " .
            $book1->getVolume();
    print "<br>";

    /* ERRORS */
    if ($error != 0) {
        print "<br>Error! Bad Data: " . Check::getErrorMessage($error);
    }
    
    if($errorreg !=0){
        print "<br>Error! Bad Data: " . Checker::getErrorMessage($errorreg);
    }
    /*if($errorreg !=0){
        print "<br>Error! Bad Data: " . Checker::getErrorMessage($error);
    }*7
    
    /*if($errorreg !=0){
        print "<br>HOLA! Bad Data: " . Checker::getErrorMessage($errorreg);
    }*/
    /* Storable */
    print "<br>------STORABLE------<br>";

    function printInterface(Storable $storable) {
        print "Storable: " . "Altura: " . $storable->getHigh() . "cm" . ', ' . "Amplada: " . $storable->getWidth() . "cm" . ', ' .
                "Longitud: " . $storable->getLength() . "cm" . ', ' . "Pes: " . $storable->getWeight() . "g" . ', ' .
                "Volum: " . $storable->getVolume();
    }

    printInterface($book1);
} catch (BuildException $ex) {
    print $ex->getMessage();
}

/* Cursos */
try {
    print "<br>------CURSOS------<br>";
    $course1 = new Courses(3232, 23.45, "Programació", 567, "PHP");
    $error = $course1->setCode(1455454);
    print $course1->getDetails();

    /* ERRORS */
    if ($error != 0) {
        print "<br>Error! Bad Data: " . Check::getErrorMessage($error);
    }
    /* Marketable */
    print "<br>";
    print "<br>------MARKETABLE------<br>";

    function printInterface1(Marketable $marketable) {
        print "Marketable: " . "Preu: " . $marketable->getPrice() . "€" . ', ' . "Descripció: " . $marketable->getDescription() . ', ' .
                "Codi producte: " . $marketable->getCode();
    }

    printInterface1($course1);
    printInterface1($book1);
    print "<br>";
} catch (Exception $ex) {
    print $ex->getMessage();
}

