<?php
include "php/class/Adoption.php";
include "php/class/Payment.php";
include "php/class/Animal.php";
include "php/class/DBConnection.php";
include "php/class/ImgUpload.php";
include "php/class/User.php";
$usr = new User();

if($usr->getSession()){
    $usr->setID($_SESSION['id']);
}


$adop = new Adoption();
$adop->setIdZwierze(4);
$adop->setIdUzytkownik($usr->getId());
//var_dump($adop->getPathZdjecia());
$adop->newAdoption();
//$adop->setId(6);


$pay = new Payment();
$pay->setIdAdopcji($adop->getId());
$pay->setIdKlienta($usr->getId());
$pay->setIleMiesiecy(3);

$zwierz = new Animal();
$zwierz->setID(4);
$zwierz_data = $zwierz->getAnimalInfo();

$pay->setKwota($pay->getIleMiesiecy() * $zwierz_data["koszta_miesiac"]);
echo   $pay->makePayment();