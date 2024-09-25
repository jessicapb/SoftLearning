<?php

include_once 'Product.php';
include_once '../../exceptions/BuildException.php';

class Courses extends Product {

    protected int $hours;
    protected string $department;
    protected int $password;

    public function __construct(int $code, float $price, string $description,
            int $hours, string $department) {
        $message = "";
        try {
            parent::__construct($code, $price, $description);
        } catch (BuildException $ex) {
            $message .= $ex->getMessage();
        }

        if (($error = $this->setHours($hours)) != 0) {
            $message .= "Bad Hour, ";
        }

        if (($error = $this->setDepartment($department)) != 0) {
            $message .= "Bad Department.";
        }

        if (($error = $this->setPassword("7890")) != 0) {
            $message .= "Bad Password<br>";
        }

        if (strlen($message) > 0) {
            throw new BuildException($message);
        }
    }

    public function getHours(): int {
        return $this->hours;
    }

    public function getDepartment(): string {
        return $this->department;
    }

    public function getPassword(): int {
        return $this->password;
    }

    public function setHours(int $hours): int {
        if (Check::isNull($hours) !=0) {
            return -1;
        }
        if (Check::minLenght($hours, 3) !=0) {
            return -2;
        }
        if (Check::isNegative($hours, -1) == true) {
            return -3;
        }
        $this->hours = $hours;
        return 0;
    }

    public function setDepartment(string $department): int {
        if (Check::isNull($department) !=0) {
            return -1;
        }
        if (Check::minLenght($department, 3) !=0) {
            return -2;
        }
        $this->department = $department;
        return 0;
    }

    public function setPassword(string $password): int {
        if (Check::isNull($password) !=0) {
            return -1;
        }
        if (Check::minLenght($password, 4) !=0) {
            return -2;
        }
        $this->password = $password;
        return 0;
    }

    public function getDetails() {
        return "Codi producte: " . $this->getCode() . ', ' .
               "Preu: " . $this->getPrice() . "€" . ', ' .
               "Descripció: " . $this->getDescription() . ', ' .
               "Hores: " . $this->getHours() . "h" . ', ' .
               "Departament: " . $this->getDepartment() . "<br>";
    }
}
