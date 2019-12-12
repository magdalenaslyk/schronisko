<?php
include "php/class/Animal.php";
include "php/class/DBConnection.php";
include "php/class/ImgUpload.php";
include "templates/header.php";
if($_SESSION['rola']!=="admin"){
    header("location:user_panel.php");
} 
?>
    <div class="container-fluid hero-container-pages">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="text-light display-1">Dodaj zwierzaka</h1>
            </div>
        </div>
      </div>

<?php
$animal = new Animal();

//if ($user->getSession()===TRUE) {
//header("location:home.php");
//}
$status = '';

$errors = array();
//If our form has been submitted.
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
        $addAnimal = $animal->addAnimal();
        if ($addAnimal) {
            $status = "<div class='alert alert-success' style='text-align:center'>Zwierzak dodany pomyślnie <a href='".SITE_URL."home.php'>Kliknij tutaj</a> żeby zobaczyć</div>";
        } else {
            $status = "<div class='alert alert-danger' style='text-align:center'>Dodawanie nieudane. Spróbuj ponownie.</div>";
        }
    }
}

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center mt-5">
            <h2>Dodawanie zwierzaka do bazy danych</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12"><?php echo $status; ?></div>
    </div>
    <div class="row">
        <div class="col-lg-12"><ul><?php
                foreach ($errors as $value) {
                    echo '<li style="color: red; font-size: 13px;">'.$value.'</li>' ;
                }
                ?></ul></div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form action="" method="post" name="add" enctype="multipart/form-data">
            <div class="form-group">
                <label for="imie">Imię zwierzaka</label>
                <input type="text" class="form-control" name="uimie" id="imie"></input>
            </div>
            <div class="form-group">
                Gatunek: <select name="ugatunek" class="form-control" >
                    <option value="pies">Pies</option>
                    <option value="kot">Kot</option>
                </select>
            </div>
            <div class="form-group">
                Rasa: <input type="text" name="urasa" class="form-control"></input><br>
            </div>
            <div class="form-group">
                Płeć: <select name="uplec" class="form-control">
                    <option value="pies">Pies</option>
                    <option value="suka">Suka</option>
                    <option value="kot">Kot</option>
                    <option value="kotka">Kotka</option>
                </select>
            </div>
            <div class="form-group">
                Wiek: <input type="text" name="uwiek" class="form-control"></input>
            </div>
            <div class="form-group">
                Status: <select name="ustatus" class="form-control">
                    <option value="do adopcji">Do adopcji</option>
                    <option value="w domu">W domu</option>
                    <option value="died">Za tęczowym mostem</option>
                    <option value="zaadoptowany wirtualnie">Zaadoptowany wirtualnie</option>
                </select>
            </div>
            <div class="form-group">
                Opis: <textarea name="uopis" rows="10" cols="30" class="form-control"></textarea>
            </div>
            <div class="form-group">
                Zdjęcie: <input type="file" name="uzdjecie" id="fileToUpload" class="form-contro-file"></input>
            </div>
            <div class="form-group">
                Czy zwierzę miało zabieg kastracji/sterylizacji? <select name="ukastracja" class="form-control">
                    <option value="tak">Tak</option>
                    <option value="nie">Nie</option>
                </select>
            </div>
            <div class="form-group">
                Czy zwierzę jest szczepione? <select name="uszczepienia" class="form-control"> 
                    <option value="tak">Tak</option>
                    <option value="nie">Nie</option>
                </select>
            </div>
            <div class="form-group">
                Miesięczny koszt utrzymania: <input type="number" name="ukoszta" min="1" max="9999999999" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit" name="submit" class="float-right btn btn-primary">Dodaj zwierzaka</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
include('templates/footer.php');
?>

    </body>
</html>
