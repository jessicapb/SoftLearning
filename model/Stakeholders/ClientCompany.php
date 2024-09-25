<?php

include_once 'Client.php';
include_once 'CompanyData.php';
include_once 'operations/Check.php';
include_once 'BuildException.php';

class ClientCompany extends Client {

    protected CompanyData $comp;

    public function __construct(string $name, string $surname, string $email, string $number, string $address, string $antiquity,
            string $ident, string $paymentcode, int $workers, string $socialreason) {
        $message = "";
        try {
            parent::__construct($name, $surname, $email, $number, $address, $antiquity, $ident, $paymentcode); //hereda de Client
        } catch (BuildException $ex) {
            $message .= $ex->getMessage();
        }

        try {
            $this->comp = new CompanyData($workers, $socialreason);
        } catch (BuildException $ex) {
            $message .= $ex->getMessage();
        }

        if (strlen($message) > 0) {
            throw new BuildException($message);
        }
    }

    //IMPLEMENTACIÓN METODOS PÚBLICOS PARA COMPANY DATA
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
}
