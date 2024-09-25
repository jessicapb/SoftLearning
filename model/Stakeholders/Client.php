<?php

include_once 'Person.php';
include_once 'Stakeholder.php';

class Client extends Person implements Stakeholder {

    protected string $paymentcode;

    public function __construct(string $name, string $surname, string $email, string $number, string $address,
            string $antiquity, int $ident, string $paymentcode) {
        $message = "";
        try {
            parent::__construct($name, $surname, $email, $number, $address, $antiquity, $ident); //crida explícita al mètode constructor de Persona
        } catch (BuildException $ex) {
            $message .= $ex->getMessage();
        }

        if ($error = $this->setPaymentcode($paymentcode) != 0) {
            $message .= "Bad paymentcode, ";
        }

        if (strlen($message) > 0) {
            throw new BuildException($message);
        }
    }
    
    
    public function getPaymentcode(): string {
        return $this->paymentcode;
    }

    public function setPaymentcode(string $paymentcode): int {
        if (Check::isNull($paymentcode) != 0) {
            return -1;
        }
        if (Check::minLenght($paymentcode, 5) != 0) {
            return -2;
        }
        $this->paymentcode = $paymentcode;
        return 0;
    }

    public function getContactData(): string {
        return "Nom: " . $this->getName() . ', ' .
                "Cognoms: " . $this->getSurname() . ', ' .
                "Aniversari: " . $this->getAntiquity() . ', ' .
                "Email: " . $this->getEmail() . ', ' .
                "Número telèfon: " . $this->getNumber() . ', ' .
                "Adreça: " . $this->getAddress() . ', ' .
                "Número del soci: " . $this->getIdent() . ', ' .
                "Mètode de pagament: " . $this->getPaymentcode() . "<br>";
    }
}
