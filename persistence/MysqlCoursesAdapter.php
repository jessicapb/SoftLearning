<?php

include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/Products/Courses.php');
include_once 'MysqlAdapter.php';

class MysqlCoursesAdapter extends MysqlAdapter {

    //Afegir un client 
    public function addCourse(Courses $c): bool {
        try {
            // Ejecutar la consulta SQL y devolver el resultado
            return $this->writeQuery("INSERT INTO courses (codi, preu, descripcio, hores, departament) VALUES ('"
                            . $c->getCode() . "', '"
                            . $c->getPrice() . "', '"
                            . $c->getDescription() . "', '"
                            . $c->getHours() . "', '"
                            . $c->getDepartment() . "')");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al introducir el curs: " . $ex->getMessage());
        }
    }

    //Selecciona curs
    public function getCourse(int $code): Courses {
        $dataCourse = $this->readQuery("SELECT * FROM courses WHERE codi =" . $code . ";");
        if (count($dataCourse) > 0) {
            return new Courses((int) $dataCourse[0]["codi"], $dataCourse[0]["preu"], $dataCourse[0]["descripcio"],
                    (int) $dataCourse[0]["hores"], $dataCourse[0]["departament"]);
        } else {
            throw new ServiceException("No s'ha trobat el curs amb l'identificador: " . $code);
        }
    }

    //Comprovar sí el client existeix
    public function exists(string $curs): bool {
        try {
            $codi = $this->readQuery("SELECT codi FROM courses WHERE codi='" . $curs . "';");
            if (count($codi) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir el curs:" . $ex->getMessage());
        }
    }

    //Actualitzar llibre
    public function updateCourse(Courses $c): bool {
        try {
            $sql = $this->writeQuery("UPDATE courses SET " .
                    "preu = '" . $c->getPrice() . "', " .
                    "descripcio = '" . $c->getDescription() . "', " .
                    "hores = '" . $c->getHours() . "', " .
                    "departament = '" . $c->getDepartment() . "' " .
                    "WHERE Codi = " . $c->getCode() . ";");
            return $sql;
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut actualizar el curs: " . $ex->getMessage());
        }
    }

    // Eliminar el llibre
    public function deleteCourse(int $code): bool {
        try {
            return $this->writeQuery("DELETE FROM courses WHERE codi = " . $code . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut esborrar el curs amb el número: " . $code . $ex->getMessage());
        }
    }

    //autentificar
    public function authentication(string $course): Courses {
        try {
            $codi = $this->readQuery("SELECT codi FROM courses WHERE codi='" . $course . "';");
            if (count($codi) > 0) {
                return $this->getCourse((int) $codi[0]["codi"]);
            } else {
                throw new ServiceException("No existeix el llibre: " . $course);
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir el curs: " . $ex->getMessage());
        }
    }
}
