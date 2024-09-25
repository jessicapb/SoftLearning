<?php

include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/Stakeholders/Employee.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/persistence/MysqlAdapter.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/exceptions/checkdata/Checker1.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/exceptions/ServiceException.php');

class MysqlEmployeeAdapter extends MysqlAdapter {

    //Afegir un employee 
    public function addEmployee(Employee $e): bool {
        try {
            // Ejecutar la consulta SQL y devolver el resultado
            return $this->writeQuery("INSERT INTO employee (nom, cognoms, email, telefon, adreca, antiguitat, treballador, departament, horari, banc) VALUES ('"
                            . $e->getName() . "', '"
                            . $e->getSurname() . "', '"
                            . $e->getEmail() . "', '"
                            . $e->getNumber() . "', '"
                            . $e->getAddress() . "', '"
                            . $e->getAntiquity() . "', '"
                            . $e->getIdent() . "', '"
                            . $e->getDepartment() . "', '"
                            . $e->getSchedule() . "', '"
                            . $e->getBankaccount() . "')");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al introducir el treballador: " . $ex->getMessage());
        }
    }

    //Selecciona empleat
    public function getEmployee(int $ident): Employee {
        $dataEmployee = $this->readQuery("SELECT * FROM employee WHERE treballador =" . $ident . ";");
        if (count($dataEmployee) > 0) {
            $d = $this->convertYMDtoDMY($dataEmployee[0]["antiguitat"]);
            return new Employee($dataEmployee[0]["nom"], $dataEmployee[0]["cognoms"], $dataEmployee[0]["email"], $dataEmployee[0]["telefon"],
                    $dataEmployee[0]["adreca"], $d, (int) $dataEmployee[0]["treballador"], $dataEmployee[0]["departament"],
                    $dataEmployee[0]["horari"], (int) $dataEmployee[0]["banc"]);
        } else {
            throw new ServiceException("No s'ha trobat el treballador amb l'identificador: " . $ident);
        }
    }

    //Comprovar sí el employee existeix
    public function exists(string $employee): bool {
        try {
            $treballador = $this->readQuery("SELECT treballador FROM employee WHERE treballador='" . $employee . "';");
            if (count($treballador) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir el treballador:" . $ex->getMessage());
        }
    }

    //actualitzar client
    public function updateEmployee(Employee $e): bool {
        try {
            return $this->writeQuery("UPDATE employee SET "
                            . "nom ='" . $e->getName() . "', " .
                            "cognoms = '" . $e->getSurname() . "', " .
                            "email = '" . $e->getEmail() . "'," .
                            "telefon = '" . $e->getNumber() . "'," .
                            "adreca = '" . $e->getAddress() . "', " .
                            "antiguitat = '" . $e->getAntiquity() . "', " .
                            "departament = '" . $e->getDepartment() . "', " .
                            "horari = '" . $e->getSchedule() . "', " .
                            "banc = '" . $e->getBankaccount() . "'" .
                            " WHERE treballador = " . $e->getIdent() . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut actualizar el treballador: " . $ex->getMessage());
        }
    }

    //eliminar empleat
    public function deleteEmployee(int $ident): bool {
        try {
            return $this->writeQuery("DELETE FROM employee WHERE treballador = " . $ident . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut eliminar el treballador: " . $ident . $ex->getMessage());
        }
    }

    //autentificar
    public function authentication(string $employee): Employee {
        try {
            $treballador = $this->readQuery("SELECT treballador FROM employee WHERE treballador='" . $employee . "';");
            if (count($treballador) > 0) {
                return $this->getEmployee((int) $treballador[0]["treballador"]);
            } else {
                throw new ServiceException("No existeix el treballador: " . $employee);
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir el treballador: " . $ex->getMessage());
        }
    }
}
