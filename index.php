<?php

include './components/config.php';
include './components/functions.php';

session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
  header('Location: ./staff_login.php');
}

include './components/staff_header.php';

?>

<!DOCTYPE html>
<html>

<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      font-family: Arial;
      margin: 0;
    }
  </style>

<body>


  <button id="defaultOpen" class="tablink" onclick="openPage('home', this,'green')"> Home </button>
  <button class="tablink" onclick="openPage('in_progress', this,'green')"> In Progress </button>
  <button class="tablink" onclick="openPage('closed', this,'green')"> Closed Clients </button>
  <button class="tablink" onclick="openPage('history', this,'green')"> history </button>

  <section id="home" class="tabcontent">

    <div class="-container green-border" style="margin-top:50px">
      <div class="row">
        <div class="col">
          <h1 class="left-assign text-green pointer">Mr.
            <?= $fetch_profile["name"]; ?></span>
          </h1><br>
          <h1 class="left-assign text-green pointer">
            <?= $fetch_profile["email"]; ?></span>
          </h1>
        </div>
        <div>
          <ul class="text-green">
            <li>
              <p>On Progress</p>
            </li><br>
            <li>
              <p>Closed Clients</p>
            </li> <br>
            <li>
              <p>Your History</p>
            </li><br>
          </ul>
        </div>

      </div>

      <div class="row">
        <div class="col">
          <a class="-button green" href="./update_profile.php" class="btn">Edit Profile</a>
        </div>
        <div>
          <a class="-button green" href="./staff_login.php" class="btn">Logout</a>
        </div>
      </div>
    </div>
  </section>

  <section id="in_progress" class="tabcontent">
    <?php include './in_progress.php'; ?>
  </section>
  <section id="closed" class="tabcontent">
    <?php include './closed_clients.php'; ?>
  </section>
  <section id="history" class="tabcontent">
    <?php include './recent_his.php'; ?>
  </section>

  <br><br><br><br><br>

  <script>

    // Fullscreen nav- tabs

    function openPage(pageName, elmnt, color) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
      }
      document.getElementById(pageName).style.display = "block";
      elmnt.style.backgroundColor = color;
    }

    document.getElementById("defaultOpen").click();


  </script>

  <?php include './components/staff_footer.php'; ?>

</body>

</html>