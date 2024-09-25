<?php

include_once 'operations/Check.php';
include_once 'Marketable.php';


abstract class Product implements Marketable {

    protected int $code;
    protected float $price;
    protected string $description;

    public function __construct(int $code, float $price, string $description) {
        $message = "";

        if (($error = $this->setCode($code)) != 0) {
            $message .= "Bad Code,";
        }

        if (($error = $this->setPrice($price)) != 0) {
            $message .= " Bad Price,";
        }

        if (($error = $this->setDescription($description)) != 0) {
            $message .= " Bad Description, ";
        }

        if (strlen($message) > 0) {
            throw new BuildException("Not posible create the object: " . $message);
        }
    }

    public function getCode(): int {
        return $this->code;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setCode(int $code): int {
        if (Check::isNull($code) != 0) {
            return -1;
        }
        if (Check::minLenght($code, 4) != 0) {
            return -2;
        }
        if (Check::isNegative($code, -1) == true) {
            return -3;
        }
        $this->code = $code;
        return 0;
    }

    public function setPrice(float $price): int {
        if (Check::isNull($price) != 0) {
            return -1;
        }
        if (Check::minLenght($price, 4) != 0) {
            return -2;
        }
        if (Check::isNegative($price, -1) == true) {
            return -3;
        }
        $this->price = $price;
        return 0;
    }

    public function setDescription(string $description): int {
        if (Check::isNull($description) != 0) {
            return -1;
        }
        if (Check::minLenght($description, 4) != 0) {
            return -2;
        }
        $this->description = $description;
        return 0;
    }

    public abstract function getDetails();
}
