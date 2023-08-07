<?php
include '../components/config.php';
include '../components/functions.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['register'])){
      $name = $_POST['name'];
      $name = filter_var($name, FILTER_SANITIZE_STRING);
      $email = $_POST['email'];
      $email = filter_var($email, FILTER_SANITIZE_STRING);
      $pass = sha1($_POST['pass']);
      $pass = filter_var($pass, FILTER_SANITIZE_STRING);
      $cpass = sha1($_POST['cpass']);
      $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);    

      $staff_info = $conn->prepare("SELECT * FROM `admin_info` WHERE email = ?");
      $staff_info->execute([$email]);
      $row = $staff_info->fetch(PDO::FETCH_ASSOC);
      $rowcount = $staff_info->rowcount();

     if($staff_info->rowCount() > 0){
      $prompt[] = 'email already exists!';
      prompt($prompt);
     }
     else if($pass != $cpass){
      $prompt[] = 'confirm password not matched!';
      prompt($prompt);  
    }
     else{
        $insert_user = $conn->prepare("INSERT INTO `admin_info`(name, email, password) VALUES(?,?,?)");
        $insert_user->execute([$name, $email, $cpass]);
        $prompt[] = 'registered successfully!';
        header('Locaion: ./admin_login.php');
        prompt($prompt);
        exit();
     }
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=0.5">
<link rel="stylesheet" href="style/style.css">
<link rel="stylesheet" href="style/style-dash.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
  .gradient-custom {
/* fallback for old browsers */
background: rgb(13, 129, 13);

/* Chrome 10-25, Safari 5.1-6 */
background: -webkit-linear-gradient(to right, rgb(13, 129, 13), rgb(144, 238, 144));

/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
background: linear-gradient(to right, rgb(13, 129, 13), rgb(144, 238, 144))
}
</style>

<body class="gradient-custom">

<section class="vh-100">
<?php echo prompt($prompt);?>
  <div class="container py-5 h-100">

            <div class="mb-md-5 mt-md-4 pb-5">
            
              <h2 class="fw-bold mb-2 text-uppercase w3-text-orange">SIGN UP</h2>
              <br>
              <form method="post" action="">
              <div class="form-outline form-white mb-4">
              <h3>Name</h3>
                <input type="text" name="name" class="form-control form-control-lg" placeholder="enter your name" required/>
              </div>

              <div class="form-outline form-white mb-4">
              <h3>Email Id</h3>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="enter your email" />
              </div>

              <div class="form-outline form-white mb-4">
              <h3>Password</h3>
                <input type="password" name="pass" class="form-control form-control-lg" placeholder="enter your password" required/>
              </div>

              <div class="form-outline form-white mb-4">
              <h3>Confirm Password</h3>
                <input type="password" name="cpass" class="form-control form-control-lg" placeholder="re-enter your password" required />
              </div>
              <br>
              <h2 class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!"><h3>Forgot password?</h3></a></h2>

              <button class="btn btn-outline-light btn-lg px-5" name="register" type="submit">Register</button>
              </form>
            </div>
            <div>
              <p class="mb-0"><h4>Already a Admin?</h4> <a href="./admin_login.php" class="text-white-50 fw-bold"><h4>LOGIN NOW</h4></a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>