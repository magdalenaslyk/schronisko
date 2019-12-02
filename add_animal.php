<?php
include "php/class/Animal.php";
include "php/class/User.php";

$user = new User();

if ($user->getSession()===TRUE) {
    header("location:home.php");
}
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
            $status = "<div class='alert alert-success' style='text-align:center'>Added successful <a href='".SITE_URL."index.php'>Click here</a> to login</div>";
        } else {
            $status = "<div class='alert alert-danger' style='text-align:center'>Add failed. Try again.</div>";
        }
    }
}

?>
<?php
//include('templates/header.php');
?>
    <div class="row">
        <div class="col-lg-12">
            <h2>Simple Add using PHP & MySQL</h2>
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
                <input type="text" name="uimie"></input><br>
                <input type="text" name="ugatunek"></input><br>
                <input type="text" name="urasa"></input><br>
                <select name="uplec">
                    <option value="pies">Pies</option>
                    <option value="suka">Suka</option>
                    <option value="kot">Kot</option>
                    <option value="kotka">Kotka</option>
                </select><br>
                <input type="text" name="uwiek"></input><br>
                <select name="ustatus">
                    <option value="do adopcji">Do adopcji</option>
                    <option value="w domu">W domu</option>
                    <option value="died">Za tęczowym mostem</option>
                    <option value="zaadoptowany wirtualnie">Zaadoptowany wirtualnie</option>
                </select>
                <textarea name="uopis" rows="10" cols="30"></textarea><br>
                <input type="file" name="uzdjecie" id="fileToUpload"></input><br>
                <select name="ukastracja">
                    <option value="tak">Tak</option>
                    <option value="nie">Nie</option>
                </select>
                <select name="uszczepienia">
                    <option value="tak">Tak</option>
                    <option value="nie">Nie</option>
                </select>
                <input type="number" name="ukoszta" min="1" max="9999999999">
                <button type="submit" name="submit" class="float-right btn btn-primary">Add</button>
                <a href="<?php print SITE_URL; ?>index.php">Already registered? Click Here!</a>
            </form>
        </div>
    </div>
<?php
//include('templates/footer.php');
?>