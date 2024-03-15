<?php 
require_once 'php/db_connect.php';

session_start();

if(isset($_SESSION['userId'])) {
  header('location:'.$farm_url.'edashboard.php');    
}

$errors = array();

if($_POST) {    

  $username = $_POST['username'];
  $password = $_POST['password'];

  if(empty($username) || empty($password)) {
    if($username == "") {
      $errors[] = "Username is required";
    } 

    if($password == "") {
      $errors[] = "Password is required";
    }
  } 
  else {
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $connect->query($sql);

    if($result->num_rows == 1) {
      $password = md5($password);
      // exists
      $mainSql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
      $mainResult = $connect->query($mainSql);

      if($mainResult->num_rows == 1) {
        $value = $mainResult->fetch_assoc();
        $user_id = $value['user_id'];
        if($user_id!=1)
          {
        // set session
        $_SESSION['userId'] = $user_id;

            header('location:'.$farm_url.'edashboard.php'); 
        }
      } else{
        
        $errors[] = "Incorrect username/password combination";
      }  
    } else {    
      $errors[] = "Username doesnot exists";    
    }  
  }  
  
}  
?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
   
  <link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
  <script src="assests/jquery/jquery.min.js"></script>
     
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css"> 
   
  <link rel="stylesheet" href="custom/css/elogin3.css">
 
</head>
<body>

  

<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" id="loginForm">

  <section class="login-block">
         <!-- For Validation Message.. -->
  <div class="messages">
              <?php if($errors) {
                foreach ($errors as $key => $value) {
                  echo '<div class="alert alert-warning" role="alert">
                  <i class="glyphicon glyphicon-exclamation-sign"></i>
                  '.$value.'</div>';                    
                  }
                } ?>
  </div>
    <div class="container">

  <div class="row">

    <div class="col-md-4 login-sec">
        <h2 class="text-center">STAFF LOGIN</h2>
        <form class="login-form">
  <div class="form-group">
    <label for="exampleInputEmail1" class="text-uppercase">Username</label>
   <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" />
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
  </div>
  
  
    <div class="form-check">
    <center>
      <button type="submit" class="btn btn-default"> <i class="glyphicon glyphicon-log-in"></i> Sign in</button>
    </center>
  </div>
  
</form>
 
  </div>
    <div class="col-md-8 banner-sec">
            
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="bg.jpg" alt="AP AGRO FARM">
       
        <div class="banner-text">
            <h2 style="font-size: 55px; color: white; text-shadow: 0 0 3px black, 0 0 5px #62de77;">AP AGRO FARM</h2>
            <p style="text-shadow: 0 0 3px black, 0 0 5px #62de77;">Rasuwa,Dhunche</p>
          
        </div>
    </div>
    
  </div>
             
</div>
</section>
</body>
</html>



