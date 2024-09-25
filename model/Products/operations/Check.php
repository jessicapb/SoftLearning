<?php

class Check {

    //Buit set
    public static function isNull($s): bool {
        return $s == null ? true : false;
        /* if ($s == null) {
          return true;
          } else {
          return false;
          } */
    }
    
    //Longitud del set
    public static function minLenght(string $s, int $lenght): int {
        if (Check::isNull($s)) {
            return -1;
        }
        return strlen(trim($s)) >= $lenght ? 0 : -3;
    }
    
    //Negatiu set
    public static function isNegative(string $n): bool {
        return $n < 0 ? true : false;
    }
    
    //Identificador dels set (errors) dels fitxers del Stakeholders o Product
    public static function getErrorMessage(int $e): string {
        switch ($e) {
            case 0: return "Done";
            case -1: return "Null";
            case -2: return "Empty";
            case -3: return "Negative";
        }
    }
}
