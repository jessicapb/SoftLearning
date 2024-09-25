<?php

include($_SERVER['DOCUMENT_ROOT'] . '/SoftLearning/model/Products/Books.php');
include_once 'MysqlAdapter.php';

class MysqlBookAdapter extends MysqlAdapter {

    //Afegir un client 
    public function addBook(Books $b): bool {
        try {
            // Ejecutar la consulta SQL y devolver el resultado
            return $this->writeQuery("INSERT INTO book (Codi, Preu, Descripcio, Autor, Titol, Tapa, Pagines, Genere, Editorial, ISBN, Altura, Amplada, Longitud, Pes) VALUES ('"
                            . $b->getCode() . "', '"
                            . $b->getPrice() . "', '"
                            . $b->getDescription() . "', '"
                            . $b->getAuthor() . "', '"
                            . $b->getTitle() . "', '"
                            . $b->getCover() . "', '"
                            . $b->getPage() . "', '"
                            . $b->getGender() . "', '"
                            . $b->getEditorial() . "', '"
                            . $b->getISBN() . "', '"
                            . $b->getHigh() . "', '"
                            . $b->getWidth() . "', '"
                            . $b->getLength() . "', '"
                            . $b->getWeight() . "')");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al introducir el llibre: " . $ex->getMessage());
        }
    }

    //Selecciona llibre
    public function getBook(int $code): Books {
        $dataBook = $this->readQuery("SELECT * FROM book WHERE codi =" . $code . ";");
        if (count($dataBook) > 0) {
            return new Books((int) $dataBook[0]["Codi"], $dataBook[0]["Preu"], $dataBook[0]["Descripcio"], $dataBook[0]["Autor"],
                    $dataBook[0]["Titol"], $dataBook[0]["Tapa"], (int) $dataBook[0]["Pagines"], $dataBook[0]["Genere"],
                    $dataBook[0]["Editorial"], $dataBook[0]["ISBN"], $dataBook[0]["Altura"], $dataBook[0]["Amplada"],
                    $dataBook[0]["Longitud"], $dataBook[0]["Pes"]);
        } else {
            throw new ServiceException("No s'ha trobat el llibre amb l'identificador: " . $code);
        }
    }
    
    //Comprovar sí el llibre existeix
    public function exists(string $llibre): bool {
        try {
            $soci = $this->readQuery("SELECT Codi FROM book WHERE Codi='" . $llibre . "';");
            if (count($soci) > 0) {
                return true;
            } else {
                return false;
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir el llibre:" . $ex->getMessage());
        }
    }

    //Actualitzar llibre
    public function updateBook(Books $b): bool {
        try {
            $sql = $this->writeQuery("UPDATE book SET " .
                    "Preu = '" . $b->getPrice() . "', " .
                    "Descripcio = '" . $b->getDescription() . "', " .
                    "Autor = '" . $b->getAuthor() . "', " .
                    "Titol = '" . $b->getTitle() . "', " .
                    "Tapa = '" . $b->getCover() . "', " .
                    "Pagines = '" . $b->getPage() . "', " .
                    "Genere = '" . $b->getGender() . "', " .
                    "Editorial = '" . $b->getEditorial() . "', " .
                    "ISBN = '" . $b->getISBN() . "', " .
                    "Altura = '" . $b->getHigh() . "', " .
                    "Amplada = '" . $b->getWidth() . "', " .
                    "Longitud = '" . $b->getLength() . "', " .
                    "Pes = '" . $b->getWeight() . "' " .
                    "WHERE Codi = " . $b->getCode() . ";");

            return $sql;
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut actualizar el llibre: " . $ex->getMessage());
        }
    }

    // Eliminar el llibre
    public function deleteBook(int $code): bool {
        try {
            return $this->writeQuery("DELETE FROM book WHERE Codi = " . $code . ";");
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("No s'ha pogut esborrar el llibre amb el número: " . $code . $ex->getMessage());
        }
    }

    //autentificar
    public function authentication(string $book): Books {
        try {
            $codi = $this->readQuery("SELECT Codi FROM book WHERE Codi='" . $book . "';");
            if (count($codi) > 0) {
                return $this->getBook((int) $codi[0]["Codi"]);
            } else {
                throw new ServiceException("No existeix el llibre: " . $book);
            }
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("Error al llegir el llibre: " . $ex->getMessage());
        }
    }
}
