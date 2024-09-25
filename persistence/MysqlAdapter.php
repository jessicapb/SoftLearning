<?php

//include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/exceptions/ExceptionService.php');

class MysqlAdapter {

    protected mysqli $connection;
    protected bool $connected = false;

    public function __construct() {
        try {
            $this->connection = new mysqli("127.0.0.1", "jessica", "Joquese2024", "softlearning", 3306);
            $this->connected = true;
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("DB Connection Failure: " . $ex->getMessage());
        }
    }

    //tanca la connexió
    public function __destruct() {
        $this->closeConnection();
    }

    //comproba si està conectat
    public function isConnected(): bool {
        return $this->connected;
    }

    //connecta amb la base de daes
    public function connect(string $host, string $user, string $password, string $db, int $port) {
        //tanca una base de dades
        if ($this->connected == true) {
            $this->closeConnection();
        }
        //reconectar a un altre servidor
        try {
            $this->connection = new mysqli($host, $user, $password, $db, $port);
            $this->connected = true;
        } catch (mysqli_sql_exception $ex) {
            throw new ServiceException("DB Connection Failure: " . $ex->getMessage());
        }
    }

    //tanca totes les connexions
    public function closeConnection() {
        if ($this->connected == true) {
            $this->connection->close();
            $this->connected = false;
        }
    }

    //llegir la informació
    public function readQuery(string $query): array {
        $dataset = [];
        $result = $this->connection->query($query);
        if ($result != false) {
            while ($row = $result->fetch_assoc()) {
                $dataset[] = $row;
            }
        }
        return $dataset;
    }

    //actualizar les dades
    public function writeQuery(string $query): bool {
        $result = $this->connection->query($query);
        return $result;
    }

    //convert
    public function convertYMDtoDMY(string $fecha): string {
        $d = new DateTime($fecha);
        return $d->format('d-m-Y');
    }


}
