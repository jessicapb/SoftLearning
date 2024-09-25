<?php

include_once 'DateException.php';

class Checker1 {

    //Expressió regular ISBN del llibre
    public static function checkISBN(string $ISBN): bool {
        $RE = '/^97[7-8]{1}[0-9]{10}$/';
        if (preg_match($RE, $ISBN)) {
            return true;
        } else {
            return false;
        }
    }

    //Expressió regular Email de la Persona (Client, Proveïdor, Treballador, Empresa Client)
    public static function checkEmail(string $email): bool {
        $RE = '/^[^_,-.](\\w+)(.?){10,15}[^.][@][a-z]{5,7}[.][a-z]{2,10}$/';
        if (preg_match($RE, $email)) {
            return true;
        } else {
            return false;
        }
    }

    //Expressió regular Telèfon  de la Persona (Client, Proveïdor, Treballador, Empresa Client)
    public static function checkPhone(string $phone): bool {
        $RE = '/^34 6[0-9]{2} [0-9]{2} [0-9]{2} [0-9]{2}$/';
        if (preg_match($RE, $phone)) {
            return true;
        } else {
            return false;
        }
    }

    //Expressió regular Data  de la Persona (Client, Proveïdor, Treballador, Empresa Client)
    public static function checkDate(string $date): DateTime {
        //la fecha debe ser dd/mm/yyyy
        $patron = "~^(0[1-9]|[12][0-9]|3[01])([/-])(0[1-9]|1[012])([/-])(\d{4})$~";
        //Comprobar que el patron coincide con la fecha pasada por el usuario
        if (!preg_match($patron, $date)) {
            throw new DateException("La fecha proporcionada no es correcta, indique ambos dígitos del día y mes, separados por / o -, y los 4 dígitos del año.");
        }
        //Pasar a enteros el string de la fecha
        $dia = intval(substr($date, 0, 2));
        $mes = intval(substr($date, 3, 2));
        $ano = intval(substr($date, 6, 4));
        //Preguntar si es un año bisiesto
        $esBisiesto = ($ano % 4 == 0 && ($ano % 100 != 0 || $ano % 400 == 0));
        if ($mes == 2 && ($dia > 29 || ($dia == 29 &&!$esBisiesto))) {
            throw new DateException("En el mes de febrero no pueden haber más de 29 días en años bisiestos.");
        }
        //Que los días y los meses no superen sus máximos
        $diasPorMes = [0, 31, ($esBisiesto ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        if ($dia < 1 || $dia > $diasPorMes[$mes]) {
            throw new DateException("Fecha incorrecta. Por favor, introduzca un día válido para el mes seleccionado.");
        }
        //reemplazar los separadores que ponga por los que yo quiero
        $newdate = str_replace('-', '/', $date);
        //Crear nueva fecha con la fecha correcta
        $fechaCorrecta = DateTime::createFromFormat('d/m/Y', $newdate);
        if (!$fechaCorrecta) {
            throw new DateException("La fecha proporcionada no es válida.");
        }

        return $fechaCorrecta;
    }


    //Identificador dels set (errors) dels fitxers del Stakeholders o Prodct
    public static function getErrorMessage(int $e): string {
        switch ($e) {
            case 0: return "Done";
            case -4: return "Bad pattern ISBN";
            case -5: return "Bad pattern Email";
            case -6: return "Bad pattern Date";
            case -7: return "Bad pattern Phone";
        }
    }
}