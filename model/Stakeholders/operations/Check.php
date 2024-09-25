<?php

class Check {

    public static function notNull($s): bool {
        if ($s == null) {
            return false;
        } else {
            return true;
        }
    }

    public static function isNull($s): bool {
        return $s == null ? true : false;
        /* if ($s == null) {
          return true;
          } else {
          return false;
          } */
    }

    public static function minLenght(string $s, int $lenght): int {
        if (Check::isNull($s)) {
            return -1;
        }
        return strlen(trim($s)) >= $lenght ? 0 : -3;
    }

    public static function isNegative(string $n, int $num): int {
        if ($n < 0) {
            return -4;
        } else {
            return 0;
        }
    }

    public static function getErrorMessage(int $e): string {
        switch ($e) {
            case 0: return "Done";
            case -1: return "Null";
            case -2: return "Empty";
            case -3: return "Negative";
        }
    }
}
