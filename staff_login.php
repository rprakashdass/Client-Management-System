<?php
session_start();

include './components/config.php';
include './components/functions.php';


if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

if (isset($_POST['login'])) {

  $email = $_POST['email'];
  $email = filter_var($email, FILTER_SANITIZE_STRING);
  $pass = $_POST['pass'];
  $pass = filter_var($pass, FILTER_SANITIZE_STRING);

  $select_staff = $conn->prepare('SELECT * FROM `staff_info` WHERE email = ?');
  $select_staff->execute([$email]);
  $check_staff = $select_staff->fetch(PDO::FETCH_ASSOC);

  if ($select_staff->rowCount() > 0) {
    $_SESSION['user_id'] = $check_staff['staff_id'];
    header('Location: ./index.php');
    exit();
  } else {
    $prompt[] = 'Incorrect username or password!';
    prompt($prompt);
  }
}

?>


<!DOCTYPE html>
<html>
<title>Login</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
  body {
    position: relative;
    /* fallback for old browsers */
    background: rgb(13, 129, 13);

    /* Chrome 10-25, Safari 5.1-6 */
    background: -webkit-linear-gradient(to right, rgb(13, 129, 13), rgb(144, 238, 144));

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: linear-gradient(to right, rgb(13, 129, 13), rgb(144, 238, 144))
  }
</style>


<div class="container py-5" style="height:100px">
  <div class="row d-flex justify-content-center align-items-center">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
      <div class="card bg-dark text-white" style="border-radius: 1rem;">
        <div class="card-body p-5 text-center">
          <div class="mb-md-5 mt-md-4 pb-5">
            <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
            <br>
            <form action="" method="post">
              <div class="form-outline form-white mb-4">
                <input type="email" name="email" class="form-control form-control-lg" />
                <label class="form-label">Email</label>
              </div>

              <div class="form-outline form-white mb-4">
                <input type="password" name="pass" class="form-control form-control-lg" />
                <label class="form-label">Password</label>
              </div>

              <h2 class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">
                  <h3>Forgot password?</h3>
                </a></h2>

              <button class="btn btn-outline-light btn-lg px-5" name="login" type="login">Login</button>
            </form>


            <div>
              <p class="mb-0">
              <h4>Don't have an account?</h4><a href="./staff_register.php" class="text-white-50 fw-bold">
                <h4>Sign Up</h4>
              </a>
              </p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>

</html>