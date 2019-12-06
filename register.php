<?php
include "php/class/DBConnection.php";
include "php/class/ImgUpload.php";
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
    $unazwisko = isset($unazwisko) ? $unazwisko : null;
    $udata = isset($udata) ? $udata : null;
    $uemail = isset($uemail) ? $uemail : null;
    $ulogin = isset($ulogin) ? $ulogin : null;
    $uhaslo = isset($uhaslo) ? $uhaslo : null;
    $uzdjecie = isset($uzdjecie) ? $uzdjecie : null;
 
    if(strlen(trim($uimie)) === 0){
        $errors[] = "You must enter your imie!";
    }
    if(strlen(trim($unazwisko)) === 0){
        $errors[] = "You must enter your nazwisko!";
    }
    if(strlen(trim($udata)) === 0){
        $errors[] = "You must enter your data!";
    }
    if(!filter_var($uemail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "That is not a valid email address!";
    }
    if(strlen(trim($ulogin)) === 0){
        $errors[] = "You must enter your login";
    }
    if(strlen(trim($uhaslo)) === 0){
        $errors[] = "You must enter your password!";
    }
 
    //If our $errors array is empty, we can assume that everything went fine.
    if(empty($errors)){
        //insert data into database.
        $user->setImie($uimie);
        $user->setNazwisko($unazwisko);
        $user->setDataurodzenia($udata);
        $user->setEmail($uemail);
        $user->setLogin($ulogin);
        $user->setHaslo($uhaslo);
        $user->setZdjecie($uzdjecie);
        $register = $user->userRegistration();
        if ($register) {    
            $status = "<div class='alert alert-success' style='text-align:center'>Registration successful <a href='".SITE_URL."index.php'>Click here</a> to login</div>";
        } else {    
            $status = "<div class='alert alert-danger' style='text-align:center'>Registration failed. Email or Username already exits please try again.</div>";
        }
    }
}
 
?>
<?php
//include('templates/header.php');
?>
<div class="row">
    <div class="col-lg-12">
        <h2>Simple Login & Registration system using PHP & MySQL</h2>                 
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
        <form action="" method="post" name="reg" enctype="multipart/form-data">
                <input type="text" name="uimie"></input><br>
                <input type="text" name="unazwisko"></input><br>
                <input type="date" name="udata"></input><br>
                <input type="email" name="uemail"></input><br>
                <input type="text" name="ulogin"></input><br>
                <input type="password" name="uhaslo"></input><br>
                <input type="file" name="uzdjecie" id="fileToUpload"></input><br>    
            <button type="submit" name="submit" class="float-right btn btn-primary">Register</button>
            <a href="<?php print SITE_URL; ?>index.php">Already registered? Click Here!</a>          
        </form>
    </div>
</div>
<?php
//include('templates/footer.php');
?>