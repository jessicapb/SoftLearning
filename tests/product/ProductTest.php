<?php
include_once '../../model/Products/Books.php';
include_once '../../model/Products/Courses.php';
/* Llibres */
print "------LLIBRES------<br>";

$book1 = new Books("IDCLIENT:434343J", "CODI PRODUCTE: 3232", 23.98, "AUTORA: J.K Rowling", 
        "TÍTOL: Harry Pooter", "PORTADA: DURA", "PÀGINES: 980", "GENERE: Fantasia","EDITORIAL: Santillana", 
        "ISBN: 1212A", "DESCRIPTION: ASSA");
print  "Llibre 1: " . $book1->getDetails();

print "<br>";

/* Cursos */
print "<br>------CURSOS------<br>";

$course = new Courses("IDCLIENT: 4565678V", "CODI PRODUCTE: 4546", 23.89, "HORES: 456h", 
        "DEPARTAMENT: PHP", "CONTRASENYA: 8964","DESCRIPTION: ASSA");
print "Curs 1: " . $course->getDetails();