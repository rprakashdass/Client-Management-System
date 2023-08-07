<!DOCTYPE html>
<html>
<head>
  <title>Staff Profile</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    form {
      max-width: 400px;
      margin: 0 auto;
    }

    h1 {
      text-align: center;
    }

    label {
      display: block;
      margin-bottom: 10px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .error {
      color: red;
      margin-bottom: 10px;
    }

    .success {
      color: green;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

<div class="clear"></div>

  <form method="POST" action="">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email" required>

    <label for="old_pass">Old Password:</label>
    <input type="password" id="old_pass" name="old_pass" required>

    <label for="new_pass">New Password:</label>
    <input type="password" id="new_pass" name="new_pass">

    <label for="cpwrd">Confirm Password:</label>
    <input type="password" id="cpwrd" name="cpwrd">

    <input type="submit" name="submit" value="Update Profile">
    <input type="submit" name="logout" value="Logout">
  </form>

  <?php


if(isset($_POST['logout'])){
    header('Location: ./staff_login.php');
    exit;

}


if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $update_profile = $conn->prepare("UPDATE `staff_info` SET name = ?, email = ? WHERE staff_id = ?");
   $update_profile->execute([$name, $email, $user_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $p_pass = $_POST['p_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpwrd = sha1($_POST['cpwrd']);
   $cpwrd = filter_var($cpwrd, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){

         echo 'password is incorrect!';

   }elseif($old_pass != $p_pass){

        echo 'old password not matched!';

   }elseif($new_pass != $cpwrd){

           echo 'confirm password not matched!';

   }else{

      if($new_pass){

         $update_admin_pass = $conn->prepare("UPDATE `staff_info` SET password = ?  WHERE staff_id = ?");
         $update_admin_pass->execute([$cpwrd, $user_id]);

         echo 'password updated successfully!';

      }else{
         echo 'please enter a new password!';
      }

   }
   
}

?>


</body>
</html>
