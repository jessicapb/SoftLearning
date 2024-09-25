<?php

include_once '../../model/Stakeholders/Client.php';
include_once '../../model/Stakeholders/Provider.php';
include_once '../../model/Stakeholders/Employee.php';
include_once '../../model/Stakeholders/ClientCompany.php';
include_once '../../model/Stakeholders/Stakeholder.php';
include_once '../../model/Stakeholders/operations/Check.php';

/* Proveïdor */
try {
    /* Patrocinador */
    print "PATROCINADORS<br>";
    $provider1 = new Provider("Jessica", "Prats", "jessicaprats.nuria@gmail.com", 678909890, "Montflorit Viladecans", "345678", 122112,
            "PHP", 1221, "Education");
    print "Provedor 1: ". $provider1->getContactData();
    print "<br>Company Data: " . "Treballadors: "  . $provider1->getWorkers() . 
            " (" . $provider1->getCompanyType() . ")";
    print "<br>";
} catch (BuildException $ex) {
    print $ex->getMessage();
}

/* Client */
try {
    print "<br>CLIENT<br>";
    $client1 = new Client("Jessica", "Prats", "jessica@gmail.com", 121212121, "C/Montflorit", "100", 1212121, "Targeta");

    //$error = $client1->setEmail("jessica1@gmail.com");
    $error = $client1->setNumber(-121212211);
    $errorreg = $client1->setEmail("jessica.nuria@gmail");
    /* ERRORS */
    if ($error != 0) {
        print "Error! Bad Data: " . Check::getErrorMessage($error);
    }
    
    if($errorreg !=0){
        print "<br>Error! Bad Data: " . Checker1::getErrorMessage($errorreg);
    }
    
    print "<br>";
    print "Client 1: " . $client1->getContactData();

    /* Interficie */
    print "<br>STAKEHOLDER<br>";

    function printInterface(Stakeholder $stakeholder) {
        print "Stakeholder: " . "Nom: " . $stakeholder->getName() . ', ' . "Cognom: " . $stakeholder->getSurname()
                . ', ' . "Email: " . $stakeholder->getEmail() . ', ' . "Identificador: " . $stakeholder->getIdent();
    }

    printInterface($client1);
    print "<br>";
    printInterface($provider1);
    print "<br>";
} catch (BuildException $ex) {
    print $ex->getMessage();
}

print "<br>";

/* Treballadors */
try {
    print "<br>TREBALLADOR<br>";
    $employee1 = new Employee("Jessica", "Prats", "jessica@gmail.com", 233545454356, "Av.Milenari", "50", 34567, "PHP", 8001500,
            555323123421234);

    //$error = $employee1->setNumber(-121212211);
    //$error = $employee1->setDepartment("a");
    //$error = $employee1->setBankaccount(-1211212121);
    $error = $employee1->setSchedule(-13433232);
    /* ERRORS */
    if ($error != 0) {
        print "Error! Bad Data: " . Check::getErrorMessage($error);
    }
    print "<br>";
    print "Treballador 1: " . $employee1->getContactData();
} catch (BuildException $ex) {
    print $ex->getMessage();
}


/* Client Company */
print "<br>CLIENTS COMPANYS<br>";
$clientJessica = new ClientCompany("Jessica1", "Prats", "jessicaprats.nuria@gmail.com", 678909890, "Montflorit Viladecans",
        "345678", 1200, "Targeta", 50, "Education");
print "CC: " . $clientJessica->getName() . ": " . $clientJessica->getWorkers() . " (" . $provider1->getCompanyType() . ")";

print "<br>";
print "CC: " . $clientJessica->getName() . ": " . $clientJessica->getWorkers() . " (" . $provider1->getCompanyType() . ")";
print "<br>";

print "<br>-----INTERFICIES-------<br>";
printInterface($clientJessica);