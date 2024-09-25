<?php

include_once 'operations/Check.php';
include_once 'BuildException.php';

class CompanyData {

    protected int $workers;
    protected string $socialreason;
    protected string $companyType; //ho calcula la clase

    public function __construct(int $workers, string $socialreason) {
        $message = "";
        if ($error = $this->setworkers($workers) != 0) {
            $message .= "Bad Workers";
        }

        if ($error = $this->setSocialreason($socialreason) != 0) {
            $message .= "Bad socialreason";
        }

        if (strlen($message) > 0) {
            throw new BuildException("Not posible create the object: " . $message);
        }
    }

    public function getWorkers(): int {
        return $this->workers;
    }

    public function getSocialreason(): string {
        return $this->socialreason;
    }

    public function getCompanyType(): string {
        return $this->companyType;
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
        
        if ($workers > 250) {
            $this->companyType = "Big Company";
        } elseif ($workers <= 50) {
            $this->companyType = "Small Company";
        } else {
            $this->companyType = "Medium Company";
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
