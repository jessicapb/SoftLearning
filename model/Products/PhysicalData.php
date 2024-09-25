<?php

//include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/exceptions/BuildException.php');
include_once '../../exceptions/BuildException.php';
include_once 'operations/Check.php';

class PhysicalData {

    protected float $high; //altura
    protected float $width; //amplada
    protected float $length; //longitud
    protected int $weight; //pes
    protected float $volume; //volum ho calcula la clase

    public function __construct(float $high, float $width, float $length, int $weight) {
        $message = "";
        if (($error = $this->setHigh($high)) != 0) {
            $message .= "Bad High, ";
        }

        if (($error = $this->setWidth($width)) != 0) {
            $message .= "Bad Width, ";
        }

        if (($error = $this->setLength($length)) != 0) {
            $message .= "Bad Length, ";
        }

        if (($error = $this->setWeight($weight)) != 0) {
            $message .= "Bad Weight, ";
        }


        if (strlen($message) > 0) {
            throw new BuildException($message);
        }
    }

    public function getHigh(): float {
        return $this->high;
    }

    public function getWidth(): float {
        return $this->width;
    }

    public function getLength(): float {
        return $this->length;
    }

    public function getWeight(): int {
        return $this->weight;
    }

    public function getVolume(): float {
        return $this->volume;
    }

    public function setHigh(float $high): int {
        if (Check::isNull($high) != 0) {
            return -1;
        }
        if (Check::minLenght($high, 2) != 0) {
            return -2;
        }
        if (Check::isNegative($high, -1) == true) {
            return -3;
        }
        $this->high = $high;
        return 0;
    }

    public function setWidth(float $width): int {
        if (Check::isNull($width) != 0) {
            return -1;
        }
        if (Check::minLenght($width, 2) != 0) {
            return -2;
        }
        if (Check::isNegative($width, -1) == true) {
            return -3;
        }
        $this->width = $width;
        return 0;
    }

    public function setLength(float $length): int {
        if (Check::isNull($length) != 0) {
            return -1;
        }
        if (Check::minLenght($length, 2) != 0) {
            return -2;
        }
        if (Check::isNegative($length, -1) == true) {
            return -3;
        }
        $this->length = $length;
        return 0;
    }

    public function setWeight(int $weight): int {
        if (Check::isNull($weight) != 0) {
            return -1;
        }
        if (Check::minLenght($weight, 2) != 0) {
            return -2;
        }
        if (Check::isNegative($weight, -1) == true) {
            return -3;
        }
        $this->weight = $weight;
        return 0;
    }
    
    function getCalcularVolum(int $length, int $width, int $high):int {
        $volume=$length*$width*$high;
        return $volume;
    }
}
