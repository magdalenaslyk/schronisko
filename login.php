<?php
include "templates/header.php";
include "php/class/User.php";
include "php/class/DBConnection.php";

$msg = '';
$user = new User();
if(@$_SESSION['login']){
  if($_SESSION['rola']==="admin"){
    header("location:admin_panel.php");
  } 
  else{
    header("location:user_panel.php");
  }
}
if (isset($_POST['submit'])) { 
    extract($_POST);
    $user->setLogin($emailusername);
    $user->setHaslo($password);   
    $login = $user->doLogin();
    if ($login) {     
      if($_SESSION['rola']==="admin"){
        header("location:admin_panel.php");
      } 
      else{
        header("location:user_panel.php");
      }     

    } else {            
        $msg = 'Wrong username or password';
    }
}
?>
      <div class="container-fluid hero-container-pages">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h1 class="text-light display-1">Zaloguj się</h1>
            </div>
        </div>
      </div>
      <div class="container">
<div class="row">
    <div class="col-lg-12">
        <?php if(!empty($msg)){ 
                echo '<div class="alert alert-danger">Wrong username or password</div>';
       } ?>    
    </div>
</div>
<div class="row">
    <div class="col-lg-6 offset-lg-3 pt-5">
        <form action="" method="post" name="login">    
            <div class="input-group mb-3">
                <input type="text" name="emailusername" class="form-control" placeholder="Username/Email">
            </div>
            
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="******">        
            </div>
            
            <button type="submit" name="submit" class="float-right btn btn-primary">Login</button>
            <a href="<?php print SITE_URL; ?>register.php">Zarejestruj się i zaadoptuj jednego ze ślicznych dziubasków ojeju jej UwU</a>
        </form>
    </div>
</div>
</div>
      
<?php
include('templates/footer.php');
?>