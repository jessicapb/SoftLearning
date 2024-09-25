<?php

include_once 'Person.php';
include_once 'operations/Check.php';

class Employee extends Person {

    protected string $department;
    protected string $schedule;
    protected int $bankaccount;

    public function __construct(string $name, string $surname, string $email, string $number, string $address,
            string $antiquity, int $ident, string $department, string $schedule, int $bankaccount) {
        $message = "";
        try {
            parent::__construct($name, $surname, $email, $number, $address, $antiquity, $ident);
        } catch (BuildException $ex) {
            $message .= $ex->getMessage();
        }

        if ($error = $this->setDepartment($department) != 0) {
            $message .= "Bad department, ";
        }

        if ($error = $this->setSchedule($schedule) != 0) {
            $message .= "Bad schedule";
        }

        if ($error = $this->setBankaccount($bankaccount) != 0) {
            $message .= "Bad bankaccount";
        }

        if (strlen($message) > 0) {
            throw new BuildException($message);
        }
    }

    public function getDepartment(): string {
        return $this->department;
    }

    public function getSchedule(): string {
        return $this->schedule;
    }

    public function getBankaccount(): int {
        return $this->bankaccount;
    }

    /*public function getDays(): int {
        $fechaInicio = $this->hireDate;
        $fechaFin = $this->fireDate;//crear variable
        $interval = $fechaInicio->diff($fechaFin);
        return $interval->days;
    }
    }*/

    public function setDepartment(string $department): int {
        if (Check::isNull($department) == true) {
            return -1;
        }
        if (Check::minLenght($department, 2) != 0) {
            return -2;
        }
        $this->department = $department;
        return 0;
    }

    public function setSchedule(string $schedule): int {
        if (Check::isNull($schedule) == true) {
            return -1;
        }
        if (Check::minLenght($schedule, 4) != 0) {
            return -2;
        }
        if (Check::isNegative($schedule, -1) == true) {
            return -3;
        }
        $this->schedule = $schedule;
        return 0;
    }

    public function setBankaccount(int $bankaccount): int {
        if (Check::isNull($bankaccount) == true) {
            return -1;
        }
        if (Check::minLenght($bankaccount, 10) != 0) {
            return -2;
        }
        if (Check::isNegative($bankaccount, -1) == true) {
            return -3;
        }
        $this->bankaccount = $bankaccount;
        return 0;
    }

    public function getContactData(): string {
        return "Nom: " . $this->getName() . ', ' .
                "Cognoms: " . $this->getSurname() . ', ' .
                "Email: " . $this->getEmail() . ', ' .
                "Número telèfon: " . $this->getNumber() . ', ' .
                "Adreça: " . $this->getAddress() . ', ' .
                "Antiguitat: " . $this->getAntiquity() . ', ' .
                "Identificador: " . $this->getIdent() . ', ' .
                "Departament: " . $this->getDepartment() . ', ' .
                "Horari Laboral: " . $this->getSchedule() . ', ' .
                "Conta del banc: " . $this->getBankaccount() . "<br>";
    }
}

/* FICAR EXPIRACIÓ CONTRACTE
 public function getHireDate(): string {
        return $this->hireDate;
    }

    public function setHireDate(string $hireDate): int {
        try{
           $this->hireDate = Checker::checkDate($hireDate);
        } catch (DateException) {
            return -20; //Fecha incorrecta
        }
        return 0;
    }

    public function getFireDate(): string {
        return $this->fireDate;
    }

    public function setFireDate(string $fireDate): int {
        try{
            $this->fireDate = Checker::checkDate($fireDate);
        } catch (DateException) {
            return -20; //Fecha incorrecta
        }
        return 0;
    }
 */