<?php 

include "php/class/User.php";
include "php/class/DBConnection.php";

$msg = '';
$user = new User();
if (isset($_POST['submit'])) { 
    extract($_POST);
    $user->setLogin($emailusername);
    $user->setHaslo($password);   
    $login = $user->doLogin();
    if ($login) {           
       header("location:home.php");
    } else {            
        $msg = 'Wrong username or password';
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
    <div class="col-lg-12">
        <?php if(!empty($msg)){ 
                echo '<div class="alert alert-danger">Wrong username or password</div>';
       } ?>    
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <form action="" method="post" name="login">    
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                </div>
                <input type="text" name="emailusername" class="form-control" placeholder="Username/Email">
            </div>
            
            <div class="input-group mb-3">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
                </div>
                <input type="password" name="password" class="form-control" placeholder="******">        
            </div>
            
            <button type="submit" name="submit" class="float-right btn btn-primary">Login</button>
            <a href="<?php print SITE_URL; ?>register.php">Register</a>
        </form>
    </div>
</div>
<?php
//include('templates/footer.php');
?>