<?php

include_once 'Person.php';
include_once 'Stakeholder.php';
include_once 'CompanyData.php';

class Provider extends Person implements Stakeholder {

    protected string $sponsors;
    protected CompanyData $comp;

    public function __construct(string $name, string $surname, string $email, string $number, string $address,
            string $antiquity, int $ident, string $sponsors, int $workers, string $socialreason) {
        $message = "";
        try {
            parent::__construct($name, $surname, $email, $number, $address, $antiquity, $ident);
        } catch (BuildException $ex) {
            $message .= $ex->getMessage();
        }

        try {
            $this->comp = new CompanyData($workers, $socialreason);
        } catch (BuildException $ex) {
            $message .= $ex->getMessage();
        }

        if ($error = $this->setSponsors($sponsors) != 0) {
            $message .= "Bad sponsors";
        }

        if (strlen($message) > 0) {
            throw new BuildException($message);
        }
    }

    public function getSponsors(): string {
        return $this->sponsors;
    }

    public function setSponsors(string $sponsors): int {
        if (Check::isNull($sponsors) != 0) {
            return -1;
        }
        if (Check::minLenght($sponsors, 3) != 0) {
            return -2;
        }
        $this->sponsors = $sponsors;
        return 0;
    }

    // IMPLEMENTACIÓN MÉTODOS PÚBLICOS PARA COMPANYDATA
    public function getWorkers(): int {
        return $this->comp->getWorkers();
    }

    public function getSocialreason(): string {
        return $this->comp->getSocialreason();
    }

    public function getCompanyType(): string {
        return $this->comp->getCompanyType();
    }

    public function setWorkers(int $workers): int {
        if (Check::isNull($workers) == true) {
            return -1;
        }
        if (Check::minLenght($workers, 2) != 0) {
            return -2;
        }
        if (Check::isNegative($workers, -1) == true) {
            return -3;
        }

        $this->workers = $workers;
        return 0;
    }

    public function setSocialreason(string $socialreason): int {
        if (Check::isNull($socialreason) == true) {
            return -1;
        }
        if (Check::minLenght($socialreason, 2) != 0) {
            return -2;
        }
        $this->socialreason = $socialreason;
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
                "Empresa on treballa: " . $this->getSponsors() . "<br>";
    }

}
