<?php

include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/Stakeholders/Client.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/persistence/MysqlAdapter.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/exceptions/checkdata/Checker1.php');
include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/exceptions/ServiceException.php');

class MysqlClientAdapter extends MysqlAdapter {

    //Afegir un client 
    public function addClient(Client $c): bool {
        try {
            // Ejecutar la consulta SQL y devolver el resultado
            return $this->writeQuery("INSERT INTO client (nom, cognom, email, telefon, adreca, aniversari, soci, pagament) VALUES ('"
                            . $c->getName() . "', '"
                            . $c->getSurname() . "', '"
                            . $c->getEmail() . "', '"
                            . $c->getNumber() . "', '"
                            . $c->getAddress() . "', '"
                            . $c->getAntiquity() . "', '"
                            . $c->getIdent() . "', '"
                            . $c->getPaymentcode() . "')");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al introducir el cliente: " . $ex->getMessage());
        }
    }

    //Selecciona client
    public function getClient(int $ident): Client {
        $dataClient = $this->readQuery("SELECT * FROM client WHERE soci =" . $ident . ";");
        if (count($dataClient) > 0) {
            $d = $this->convertYMDtoDMY($dataClient[0]["aniversari"]);
            return new Client($dataClient[0]["nom"], $dataClient[0]["cognom"], $dataClient[0]["email"], $dataClient[0]["telefon"],
                    $dataClient[0]["adreca"], $d, (int) $dataClient[0]["soci"], $dataClient[0]["pagament"]);
        } else {
            throw new ServiceException("No s'ha trobat el client amb l'identificador: " . $ident);
        }
    }
    
    //Comprovar sí el client existeix
    public function exists(string $client): bool {
        try {
            $soci = $this->readQuery("SELECT soci FROM client WHERE soci='" . $client . "';");
            if (count($soci) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir el client:" . $ex->getMessage());
        }
    }

    //actualitzar client
    public function updateClient(Client $c): bool {
        try {
            return $this->writeQuery("UPDATE client SET "
                            ."nom ='". $c->getName() . "', " .
                            "cognom = '" . $c->getSurname() . "', " .
                            "email = '" . $c->getEmail() . "'," .
                            "telefon = '". $c->getNumber() . "'," .
                            "adreca = '" . $c->getAddress() . "', " .
                            "aniversari = '" . $c->getAntiquity() . "', " .
                            "pagament = '" . $c->getPaymentcode(). "'" .
                            " WHERE soci = " . $c->getIdent() . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut actualizar el client: " . $ex->getMessage());
        }
    }
    
    //eliminar client
    public function deleteClient(int $ident): bool {
        try {
            return $this->writeQuery("DELETE FROM client WHERE soci = " . $ident . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut eliminar el client: " . $ident . $ex->getMessage());
        }
    }

    //autentificar
    public function authentication(string $client): Client {
        try {
            $soci = $this->readQuery("SELECT soci FROM client WHERE soci='" . $client . "';");
            if (count($soci) > 0) {
                return $this->getClient((int) $soci[0]["soci"]);
            } else {
                throw new ServiceException("No existeix el client: " . $client);
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir el client: " . $ex->getMessage());
        }
    }
}
