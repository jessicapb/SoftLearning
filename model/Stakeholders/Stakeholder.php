<?php

interface Stakeholder {
    public function getName ():string; 
    public function getSurname():string;
    public function getEmail():string;
    public function getIdent ():int;
}