<?php
include "php/class/Adoption.php";
include "php/class/Payment.php";


$usr = new User();


$adop = new Adoption();
$adop->setIdZwierze(3);
$adop->setIdUzytkownik();
//var_dump($adop->getPathZdjecia());
echo $adop->newAdoption();

$pay = new Payment();
$pay->setIdAdopcji();