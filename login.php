<?php
include "templates/header.php";
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
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
        <a class="navbar-brand" href="#">aDogted</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/schronisko/glowna.php">Glowna <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/schronisko/adoption.php">Do adopcji</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/schronisko/login.php">Panel użytkownika</a>
            </li>
          </ul>
        </div>
    </div>
      </nav>
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
            <a href="<?php print SITE_URL; ?>register.php">Register</a>
        </form>
    </div>
</div>
</div>
      
</body>
</html>