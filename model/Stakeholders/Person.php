<?php

include_once 'operations/Check.php';
include_once 'BuildException.php';

abstract class Person {

    protected string $name;
    protected string $surname;
    protected string $email;
    protected string $number;
    protected string $address;
    protected DateTime $antiquity;
    protected int $ident;

    public function __construct(string $name, string $surname, string $email, string $number, string $address,
            string $antiquity, int $ident) {
        $message = "";
        if ($error = $this->setName($name) != 0) {
            $message .= "Bad name, ";
        }

        if ($error = $this->setSurname($surname) != 0) {
            $message .= "Bad surname, ";
        }

        if ($error = $this->setEmail($email) != 0) {
            $message .= "Bad email, ";
        }

        if ($error = $this->setNumber($number) != 0) {
            $message .= "Bad number, ";
        }

        if ($error = $this->setAddress($address) != 0) {
            $message .= "Bad address, ";
        }

        if ($error = $this->setAntiquity($antiquity) != 0) {
            $message .= "Bad Date, ";
        }

        if ($error = $this->setIdent($ident) != 0) {
            $message .= "Bad ident, ";
        }

        if (strlen($message) > 0) {
            throw new BuildException("Not posible create the object: " . $message);
        }
    }

    public function getName(): string {
        return $this->name;
    }

    public function getSurname(): string {
        return $this->surname;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getNumber(): string {
        return $this->number;
    }

    public function getAddress(): string {
        return $this->address;
    }

    public function getAntiquity(): string {
        return $this->antiquity->format('Y-m-d');
    }

    public function getIdent(): int {
        return $this->ident;
    }

    public function setName(string $name): int {
        if (Check::isNull($name) == true) {
            return -1;
        }
        if (Check::minLenght($name, 3) != 0) {
            return -2;
        }
        $this->name = $name;
        return 0;
    }

    public function setSurname(string $surname): int {
        if (Check::isNull($surname) == true) {
            return -1;
        }
        if (Check::minLenght($surname, 3) != 0) {
            return -2;
        }
        $this->surname = $surname;
        return 0;
    }

    public function setEmail(string $email): int {
        if (Check::isNull($email) == true) {
            return -1;
        }
        if (Check::minLenght($email, 1) != 0) {
            return -2;
        }
        if (Checker1::checkEmail($email) == false) {
            return -5;
        }
        $this->email = $email;
        return 0;
    }

    public function setNumber(string $number): string {
        if (Check::isNull($number) == true) {
            return -1;
        }
        if (Check::minLenght($number, 1) != 0) {
            return -2;
        }
        if (Checker1::checkPhone($number) == false) {
            return -7;
        }
        $this->number = $number;
        return 0;
    }

    public function setAddress(string $address): int {
        if (Check::isNull($address) == true) {
            return -1;
        }
        if (Check::minLenght($address, 6) != 0) {
            return -2;
        }
        $this->address = $address;
        return 0;
    }

    public function setAntiquity(string $antiquity): int {
        try {
            $this->antiquity = Checker1::checkDate($antiquity);
        } catch (DateException) {
            return -6; //Fecha incorrecta
        }
        return 0;
    }

    public function setIdent(int $ident): int {
        if (Check::isNull($ident) == true) {
            return -1;
        }
        if (Check::minLenght($ident, 4) != 0) {
            return -2;
        }
        if (Check::isNegative($ident, -1) == true) {
            return -3;
        }
        $this->ident = $ident;
        return 0;
    }

    public abstract function getContactData(): string;
}
