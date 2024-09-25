<?php

include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/Products/Product.php');
include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/Products/PhysicalData.php');
include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/model/Products/Storable.php');
include($_SERVER['DOCUMENT_ROOT'].'/SoftLearning/exceptions/checkdata/Checker1.php');

class Books extends Product implements Storable {

    protected string $author;
    protected string $title;
    protected string $cover;
    protected int $page;
    protected string $gender;
    protected string $editorial;
    protected string $ISBN;
    protected PhysicalData $phy;

    public function __construct(int $code, float $price, string $description,
            string $author, string $title, string $cover, int $page, string $gender, string $editorial,
            string $ISBN, float $high, float $width, float $length, int $weight) {
        $message = "";
        try {
            parent::__construct($code, $price, $description);
        } catch (BuildException $ex) {
            $message .= $ex->getMessage();
        }

        try {
            $this->phy = new PhysicalData($high, $width, $length, $weight);
        } catch (BuildException $ex) {
            $message .= $ex->getMessage();
        }

        if (($error = $this->setAuthor($author)) != 0) {
            $message .= "Bad author, ";
        }

        if (($error = $this->setTitle($title)) != 0) {
            $message .= "Bad title, ";
        }

        if (($error = $this->setCover($cover)) != 0) {
            $message .= "Bad cover, ";
        }

        if (($error = $this->setPage($page)) != 0) {
            $message .= "Bad page, ";
        }

        if (($error = $this->setGender($gender)) != 0) {
            $message .= "Bad gender, ";
        }

        if (($error = $this->setEditorial($editorial)) != 0) {
            $message .= "Bad editorial, ";
        }

        if (($error = $this->setISBN($ISBN)) != 0) {
            $message .= "Bad ISBN, ";
        }

        if (strlen($message) > 0) {
            throw new BuildException($message);
        }
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getCover(): string {
        return $this->cover;
    }

    public function getPage(): int {
        return $this->page;
    }

    public function getGender(): string {
        return $this->gender;
    }

    public function getEditorial(): string {
        return $this->editorial;
    }

    public function getISBN(): string {
        return $this->ISBN;
    }

    public function setAuthor(string $author): int {
        if (Check::isNull($author) == true) {
            return -1;
        }
        if (Check::minLenght($author, 5) != 0) {
            return -2;
        }
        $this->author = $author;
        return 0;
    }

    public function setTitle(string $title): int {
        if (Check::isNull($title) == true) {
            return -1;
        }
        if (Check::minLenght($title, 5) != 0) {
            return -2;
        }
        $this->title = $title;
        return 0;
    }

    public function setCover(string $cover): int {
        if (Check::isNull($cover) == true) {
            return -1;
        }
        if (Check::minLenght($cover, 3) != 0) {
            return -2;
        }
        $this->cover = $cover;
        return 0;
    }

    public function setPage(int $page): int {
        if (Check::isNull($page) == true) {
            return -1;
        }
        if (Check::minLenght($page, 3) != 0) {
            return -2;
        }
        if (Check::isNegative($page, -1) == true) {
            return -3;
        }
        $this->page = $page;
        return 0;
    }

    public function setGender(string $gender): int {
        if (Check::isNull($gender) == true) {
            return -1;
        }
        if (Check::minLenght($gender, 3) != 0) {
            return -2;
        }
        $this->gender = $gender;
        return 0;
    }

    public function setEditorial(string $editorial): int {
        if (Check::isNull($editorial) == true) {
            return -1;
        }
        if (Check::minLenght($editorial, 3) != 0) {
            return -2;
        }
        $this->editorial = $editorial;
        return 0;
    }

    public function setISBN(string $ISBN): int {
        if (Check::isNull($ISBN) == true) {
            return -1;
        }
        if (Check::minLenght($ISBN, 5) != 0) {
            return -2;
        }
        if (Check::isNegative($ISBN, -1) == true) {
            return -3;
        }
        if (Checker1::checkISBN($ISBN) == false) {
            return -4;
        }
        $this->ISBN = $ISBN;
        
        return 0;
    }

    //PhysicalData
    public function getHigh(): float {
        return $this->phy->getHigh();
    }

    public function getLength(): float {
        return $this->phy->getLength();
    }

    public function getVolume(): float {
        return $this->phy->getVolume();
    }

    public function getWeight(): int {
        return $this->phy->getWeight();
    }

    public function getWidth(): float {
        return $this->phy->getWidth();
    }

    function getCalcularVolum(int $length, int $width, int $high): int {
        $volume = $length * $width * $high;
        return $volume;
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

    public function setWeight(string $weight): int {
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

    public function getDetails() {
        return "Codi producte: " . $this->getCode() . ', ' .
                "Preu: " . $this->getPrice() . "€" . ', ' .
                "Descripció: " . $this->getDescription() . ', ' .
                "Autora: " . $this->getAuthor() . ', ' .
                "Títol: " . $this->getTitle() . ', ' .
                "Tapa: " . $this->getCover() . ', ' .
                "Pàgines: " . $this->getPage() . ', ' .
                "Genere: " . $this->getGender() . ', ' .
                "Editorial: " . $this->getEditorial() . ', ' .
                "ISBN: " . $this->getISBN() . "<br>";
    }
}
