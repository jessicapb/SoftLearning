<?php

include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/Stakeholders/Provider.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/persistence/MysqlAdapter.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/exceptions/checkdata/Checker1.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/exceptions/ServiceException.php');

class MysqlProviderAdapter extends MysqlAdapter {

    //Afegir un provider 
    public function addProvider(Provider $p): bool {
        try {
            // Ejecutar la consulta SQL y devolver el resultado
            return $this->writeQuery("INSERT INTO provider (nom, cognom, email, telefon, adreca, antiguitat, proveidor, treballa, treballador, entitat) VALUES ('"
                            . $p->getName() . "', '"
                            . $p->getSurname() . "', '"
                            . $p->getEmail() . "', '"
                            . $p->getNumber() . "', '"
                            . $p->getAddress() . "', '"
                            . $p->getAntiquity() . "', '"
                            . $p->getIdent() . "', '"
                            . $p->getSponsors() . "', '"
                            . $p->getWorkers() . "', '"
                            . $p->getSocialreason() . "')");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al introducir el proveïdor:" . $ex->getMessage());
        }
    }

    //Selecciona provider
    public function getProvider(int $ident): Provider {
        $dataProvider = $this->readQuery("SELECT * FROM provider WHERE proveidor =" . $ident . ";");
        if (count($dataProvider) > 0) {
            $d = $this->convertYMDtoDMY($dataProvider[0]["antiguitat"]);
            return new Provider($dataProvider[0]["nom"], $dataProvider[0]["cognom"], $dataProvider[0]["email"], $dataProvider[0]["telefon"],
                    $dataProvider[0]["adreca"], $d, (int) $dataProvider[0]["proveidor"], $dataProvider[0]["treballa"],
                    (int) $dataProvider[0]["treballador"], $dataProvider[0]["entitat"]);
        } else {
            throw new ServiceException("No s'ha trobat el proveïdor amb l'identificador: " . $ident);
        }
    }

    //actualitzar proveidor
    public function updateProvider(Provider $p): bool {
        try {
            return $this->writeQuery("UPDATE provider SET "
                            . "nom ='" . $p->getName() . "', " .
                            "cognom = '" . $p->getSurname() . "', " .
                            "email = '" . $p->getEmail() . "'," .
                            "telefon = '" . $p->getNumber() . "'," .
                            "adreca = '" . $p->getAddress() . "', " .
                            "antiguitat = '" . $p->getAntiquity() . "', " .
                            "treballa = '" . $p->getSponsors() . "', " .
                            "treballador = '" . $p->getWorkers() . "', " .
                            "entitat = '" . $p->getSocialreason() . "'" .
                            " WHERE proveidor = " . $p->getIdent() . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut actualizar el proveïdor: " . $ex->getMessage());
        }
    }

    //eliminar provider
    public function deleteProvider(int $ident): bool {
        try {
            return $this->writeQuery("DELETE FROM provider WHERE proveidor = " . $ident . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut eliminar el proveidor: " . $ident . $ex->getMessage());
        }
    }

    //Comprovar sí el employee existeix
    public function exists(string $provider): bool {
        try {
            $proveidor = $this->readQuery("SELECT proveidor FROM provider WHERE proveidor='" . $provider . "';");
            if (count($proveidor) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir el proveïdor:" . $ex->getMessage());
        }
    }

    //autentificar
    public function authentication(string $provider): Provider {
        try {
            $proveidor = $this->readQuery("SELECT proveidor FROM provider WHERE proveidor='" . $provider . "';");
            if (count($proveidor) > 0) {
                return $this->getProvider((int) $proveidor[0]["proveidor"]);
            } else {
                throw new ServiceException("No existeix el proveïdor: " . $provider);
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir el proveïdor: " . $ex->getMessage());
        }
    }
}
