<?php

include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/Stakeholders/ClientCompany.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/persistence/MysqlAdapter.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/exceptions/checkdata/Checker1.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/exceptions/ServiceException.php');

class MysqlClientCompanyAdapter extends MysqlAdapter {

    //Afegir un empresa client 
    public function addEmpresaClient(ClientCompany $cc): bool {
        try {
            // Ejecutar la consulta SQL y devolver el resultado
            return $this->writeQuery("INSERT INTO clientcompany (nom, cognom, email, telefon, adreca, antiguitat, empresa, pagament, treballador, entitat) VALUES ('"
                            . $cc->getName() . "', '"
                            . $cc->getSurname() . "', '"
                            . $cc->getEmail() . "', '"
                            . $cc->getNumber() . "', '"
                            . $cc->getAddress() . "', '"
                            . $cc->getAntiquity() . "', '"
                            . $cc->getIdent() . "', '"
                            . $cc->getPaymentcode() . "', '"
                            . $cc->getWorkers() . "', '"
                            . $cc->getSocialreason() . "')");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al introducir el cliente: " . $ex->getMessage());
        }
    }

    //Selecciona empresa client
    public function getClientCompany(int $ident): ClientCompany {
        $dataClientCompany = $this->readQuery("SELECT * FROM clientcompany WHERE empresa =" . $ident . ";");
        if (count($dataClientCompany) > 0) {
            $d = $this->convertYMDtoDMY($dataClientCompany[0]["antiguitat"]);
            return new ClientCompany($dataClientCompany[0]["nom"], $dataClientCompany[0]["cognom"], $dataClientCompany[0]["email"],
                    $dataClientCompany[0]["telefon"], $dataClientCompany[0]["adreca"], $d, (int) $dataClientCompany[0]["empresa"],
                    $dataClientCompany[0]["pagament"], (int) $dataClientCompany[0]["treballador"], $dataClientCompany[0]["entitat"]);
        } else {
            throw new ServiceException("No s'ha trobat l'empresa client amb l'identificador: " . $ident);
        }
    }

    //actualitzar empresa client
    public function updateClientCompany(ClientCompany $cc): bool {
        try {
            return $this->writeQuery("UPDATE clientcompany SET "
                            . "nom ='" . $cc->getName() . "', " .
                            "cognom = '" . $cc->getSurname() . "', " .
                            "email = '" . $cc->getEmail() . "'," .
                            "telefon = '" . $cc->getNumber() . "'," .
                            "adreca = '" . $cc->getAddress() . "', " .
                            "antiguitat = '" . $cc->getAntiquity() . "', " .
                            "pagament = '" . $cc->getPaymentcode() ."', " .
                            "treballador = '" . $cc->getWorkers() ."', " .
                            "entitat = '" . $cc->getSocialreason() . "'" .
                            " WHERE empresa = " . $cc->getIdent() . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut actualizar l'empresa client: " . $ex->getMessage());
        }
    }

    //eliminar empresa client
    public function deleteClientCompany(int $ident): bool {
        try {
            return $this->writeQuery("DELETE FROM clientcompany WHERE empresa = " . $ident . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut eliminar l'empresa client: " . $ident . $ex->getMessage());
        }
    }

    //Comprovar sí l'empresa client existeix
    public function exists(string $clientcompany): bool {
        try {
            $empresa = $this->readQuery("SELECT empresa FROM clientcompany WHERE empresa='" . $clientcompany . "';");
            if (count($empresa) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir l'empresa client:" . $ex->getMessage());
        }
    }

    //autentificar
    public function authentication(string $clientcompany): ClientCompany {
        try {
            $empresa = $this->readQuery("SELECT empresa FROM clientcompany WHERE empresa='" . $clientcompany . "';");
            if (count($empresa) > 0) {
                return $this->getClientCompany((int) $empresa[0]["empresa"]);
            } else {
                throw new ServiceException("No existeix l'empresa client: " . $clientcompany);
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir l'empresa client: " . $ex->getMessage());
        }
    }
}
