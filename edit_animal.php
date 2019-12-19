<?php
include "php/class/Filter.php";
include "php/class/DBConnection.php";
include "php/class/User.php";
include "php/class/Animal.php";
include "templates/Header.php";
if($_SESSION['rola']!=="admin"){
    header("location:user_panel.php");
} 
?>
<div class="container-fluid hero-container-pages">
    <div class="row">
        <div class="col-lg-12 text-center">
            <h1 class="text-light display-1">Edytuj informacje</h1>
        </div>
    </div>
</div>
<div class="container pt-5">
    <div class="row mb-5">
        <div class="col-lg-12">
            <form action="" method="post">
                <a class="btn btn-primary"  href="" role="button">Zarządzaj płatnościami</a>
                <a class="btn btn-primary"  href="add_animal.php" role="button">Dodaj zwierzaka</a>
                <a class="btn btn-primary"  href="edit_animal.php" role="button">Edytuj zwierzaka</a>
                <!--<button type="submit" class="btn btn-primary" name="add_animal">Dodaj zwierzaka</button>-->
            </form>
        </div>
    </div>
</div>
<div class="container-fluid animals pt-5 px-5">
    <div class="row">
<?php
$usr = new User();
$animal = new Animal();
$filter = new Filter();
$animal_display = $filter->getAllAnimals();



//sprawdzenie uprawnień

//pobranie informacji o zwierzęciu za pomocą id
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $animal->setID($id);
    $dane_animal = $animal->getAnimalInfo();

    //jeśli został klikniętny przycisk submit
if(isset($_POST['submit'])){
    extract($_POST);
    //Get the values of our form fields.
    $uimie = isset($uimie) ? $uimie : null;
    $ugatunek = isset($ugatunek) ? $ugatunek : null;
    $urasa = isset($urasa) ? $urasa: null;
    $uplec = isset($uplec) ? $uplec : null;
    $uwiek = isset($uwiek) ? $uwiek : null;
    $ustatus = isset($ustatus) ? $ustatus : null;
    $uopis = isset($uopis) ? $uopis : null;
    $uzdjecie = isset($uzdjecie) ? $uzdjecie : null;
    $ukastracja = isset($ukastracja) ? $ukastracja : null;
    $uszczepienia = isset($uszczepienia) ? $uszczepienia : null;
    $ukoszta= isset($ukoszta) ? $ukoszta : null;

    if(strlen(trim($uimie)) === 0){
        $errors[] = "You must enter imie!";
    }
    if(strlen(trim($ugatunek)) === 0){
        $errors[] = "You must enter gatunek!";
    }
    if(strlen(trim($urasa)) === 0){
        $errors[] = "You must enter rasa!";
    }
    if(strlen(trim($uplec)) === 0){
        $errors[] = "You must enter płeć";
    }
    if(strlen(trim($uwiek)) === 0){
        $errors[] = "You must enter wiek!";
    }
    if(strlen(trim($ustatus)) === 0){
        $errors[] = "You must enter status!";
    }
    if(strlen(trim($ukastracja)) === 0){
        $errors[] = "You must enter kastracja!";
    }
    if(strlen(trim($uszczepienia)) === 0){
        $errors[] = "You must enter szczepienia!";
    }
    if(strlen(trim($ukoszta)) === 0){
        $errors[] = "You must enter koszt!";
    }
    //If our $errors array is empty, we can assume that everything went fine.
    if(empty($errors)){
        //insert data into database.
        $animal->setID($id);
        $animal->setImie($uimie);
        $animal->setGatunek($ugatunek);
        $animal->setRasa($urasa);
        $animal->setPlec($uplec);
        $animal->setWiek($uwiek);
        $animal->setStatus($ustatus);
        $animal->setOpis($uopis);
        $animal->setZdjecie($uzdjecie);
        $animal->setKastracja($ukastracja);
        $animal->setSzczepienia($uszczepienia);
        $animal->setKoszta($ukoszta);
        $editAnimal = $animal->editAnimal();
        if ($editAnimal) {
            $status = "<div class='alert alert-success' style='text-align:center'>Edit successful <a href='".SITE_URL."home.php'>Click here</a> to see</div>";
        } else {
            $status = "<div class='alert alert-danger' style='text-align:center'>Edit failed. Try again.</div>";
        }
    }
}
else

  //jeśli nic nie zostało kliknięte to pokazuje wypełniony formularz
    echo "
<div class=\"container\">
<!--<div class='row'>
        <div class='col-lg-12'>
            <form action='' method='post' name='add' enctype='multipart/form-data'>
            <div class=\"form-group\">
        Imię zwierzaka: <input type='text' name='uimie' value =".$dane_animal["imie"]."></input><br>
    Gatunek: <select name='ugatunek' >
                    <option value='pies' selected >Pies</option>
                    <option value='kot'>Kot</option>
                    <option value=".$dane_animal["gatunek"]." selected disabled='disabled'>".$dane_animal["gatunek"]."</option>
                </select><br>
    Rasa: <input type='text' name='urasa' value =".$dane_animal["rasa"]."></input><br>
    Płeć: <select name='uplec' value =".$dane_animal["plec"].">
                    <option value='pies'>Pies</option>
                    <option value='suka'>Suka</option>
                    <option value='kot'>Kot</option>
                    <option value='kotka'>Kotka</option>
                    <option value=".$dane_animal["plec"]." selected disabled='disabled'>".$dane_animal["plec"]."</option>
                </select><br>
    Wiek: <input type='text' name='uwiek' value =".$dane_animal["wiek"]."></input><br>
    Status: <select name='ustatus'>
                    <option value='do adopcji'>Do adopcji</option>
                    <option value='w domu'>W domu</option>
                    <option value='died'>Za tęczowym mostem</option>
                    <option value='zaadoptowany wirtualnie'>Zaadoptowany wirtualnie</option>
                    <option value=".$dane_animal["status"]." selected disabled='disabled'>".$dane_animal["status"]."</option>
                </select><br>
    Opis: <textarea name='uopis' rows='10' cols='30' >".$dane_animal["opis"]."</textarea><br>
    Czy zwierzę miało zabieg kastracji/sterylizacji? <select name='ukastracja'  >
                    <option value='tak'>Tak</option>
                    <option value='nie'>Nie</option>
                    <option value=".$dane_animal["kastracja"]." selected disabled='disabled'>".$dane_animal["kastracja"]."</option>
                </select><br>
    Czy zwierzę jest szczepione? <select name='uszczepienia'>
                    <option value='tak'>Tak</option>
                    <option value='nie'>Nie</option>
                    <option value=".$dane_animal["szczepienia"]." selected disabled='disabled'>".$dane_animal["szczepienia"]."</option>
                </select><br>
    Miesięczny koszt utrzymania: <input type='number' name='ukoszta' min='1' max='9999999999' value =".$dane_animal["koszta_miesiac"]."><br>
               <button type=\"submit\" name=\"submit\" class=\"float-right btn btn-primary\">Edytuj</button>
            </form>
        </div>
    </div>-->
    <div class=\"row\">
        <div class=\"col-lg-12\">
            <form action='' method='post' name='add' enctype='multipart/form-data'>
            <div class=\"form-group\">
                <label for=\"imie\">Imię zwierzaka</label>
                <input type=\"text\" class=\"form-control\" name=\"uimie\" id=\"imie\" value =".$dane_animal["imie"]."></input>
            </div>
            <div class=\"form-group\">
                Gatunek: <select name=\"ugatunek\" class=\"form-control\" >
                    <option value=\"pies\">Pies</option>
                    <option value=\"kot\">Kot</option>
                    <option value=".$dane_animal["gatunek"]." selected disabled='disabled'>".$dane_animal["gatunek"]."</option>
                </select>
            </div>
            <div class=\"form-group\">
                Rasa: <input type=\"text\" name=\"urasa\" class=\"form-control\" value =".$dane_animal["rasa"]."></input><br>
            </div>
            <div class=\"form-group\">
                Płeć: <select name=\"uplec\" class=\"form-control\" value =".$dane_animal["plec"].">
                    <option value=\"pies\">Pies</option>
                    <option value=\"suka\">Suka</option>
                    <option value=\"kot\">Kot</option>
                    <option value=\"kotka\">Kotka</option>
                    <option value=".$dane_animal["plec"]." selected disabled='disabled'>".$dane_animal["plec"]."</option>
                </select>
            </div>
            <div class=\"form-group\">
                Wiek: <input type=\"text\" name=\"uwiek\" class=\"form-control\" value =".$dane_animal["wiek"]."></input>
            </div>
            <div class=\"form-group\">
                Status: <select name=\"ustatus\" class=\"form-control\">
                    <option value=\"do adopcji\">Do adopcji</option>
                    <option value=\"w domu\">W domu</option>
                    <option value=\"died\">Za tęczowym mostem</option>
                    <option value=\"zaadoptowany wirtualnie\">Zaadoptowany wirtualnie</option>
                    <option value=".$dane_animal["status"]." selected disabled='disabled'>".$dane_animal["status"]."</option>
                </select>
            </div>
            <div class=\"form-group\">
                Opis: <textarea name=\"uopis\" rows=\"10\" cols=\"30\" class=\"form-control\">".$dane_animal["opis"]."</textarea>
            </div>
            <div class=\"form-group\">
                Zdjęcie: <input type=\"file\" name=\"uzdjecie\" id=\"fileToUpload\" class=\"form-contro-file\"></input>
            </div>
            <div class=\"form-group\">
                Czy zwierzę miało zabieg kastracji/sterylizacji? <select name=\"ukastracja\" class=\"form-control\">
                    <option value=\"tak\">Tak</option>
                    <option value=\"nie\">Nie</option>
                    <option value=".$dane_animal["kastracja"]." selected disabled='disabled'>".$dane_animal["kastracja"]."</option>
                </select>
            </div>
            <div class=\"form-group\">
                Czy zwierzę jest szczepione? <select name=\"uszczepienia\" class=\"form-control\"> 
                    <option value=\"tak\">Tak</option>
                    <option value=\"nie\">Nie</option>
                    <option value=".$dane_animal["szczepienia"]." selected disabled='disabled'>".$dane_animal["szczepienia"]."</option>
                </select>
            </div>
            <div class=\"form-group\">
                Miesięczny koszt utrzymania: <input type=\"number\" name=\"ukoszta\" min=\"1\" max=\"9999999999\" class=\"form-control\" value =".$dane_animal["koszta_miesiac"].">
            </div>
            <div class=\"form-group\">
            <button type=\"submit\" name=\"submit\" class=\"float-right btn btn-primary href='\schronisko/edit_animal.php?a=del&amp;id={$id}'\">Edytuj</button>
            </div>
            </form>
        </div>
    </div>
</div>";

}

else



foreach($animal_display as $row){
    $t = substr($row['opis'],0,200);
    echo '
    <div class="col-lg-4 card-animal">
        <div class="row" style="flex-direction:column;padding:15px;">
            <p class="text-center"><img class="animal-img"src="/schronisko'.$row['zdjecie'].'"></p>
            <p>Imie:</p><p class="bg-primary">'.$row['imie'].'</p>
            <p>Gatunek:</p><p class="bg-primary">'.$row['gatunek'].'</p>
            <p>Rasa:</p><p class="bg-primary">'.$row['rasa'].'</p>
            <p>Płeć:</p><p class="bg-primary">'.$row['plec'].'</p>
            <p>Wiek:</p><p class="bg-primary">'.$row['wiek'].'</p>
            <p>Status:</p><p class="bg-primary">'.$row['status'].'</p>
            <p>Opis:</p><p>'.$t.'</p>';
    echo "<a class='float-right btn btn-success' href='\schronisko/edit_animal.php?a=del&amp;id={$row['id']}'>Edytuj informacje</a>";
    echo '</div> </div>';

}


?>

    </div>
</div>
<?php
include('templates/footer.php');
?>

