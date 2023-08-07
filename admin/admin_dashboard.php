<?php
include('../components/config.php');
session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
}
else{
  $user_id = '';
    header('Location: ./admin_login.php');
}

include('./admin_header.php'); 

?>

<!DOCTYPE html>
<html>

<head>
  <title>Dashboard</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../style/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
  body{
    background-color:var(--white);
  }
  </style>
</head>

<body>
  <header>
    
  </header>
  <br>
  <br>
  <section style="overflow-x: auto;">
    <div class="row-padding">
      <div class="quarter">
        <div class="container green text-white padding-64 pointer" onclick="redirectToPage('./re_assign.php')">
          <div class="left"><i class="fa fa-search xxxlarge"></i></div>
          <div class="right">
            <?php
            $query = "SELECT client_info.client_id 
            FROM `client_info`
            LEFT JOIN data_maps ON client_info.client_id = data_maps.client_id
            WHERE data_maps.client_id IS NOT NULL";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            echo '<h3>' . $rowCount . '</h3>';
            ?>
          </div>
          <div class="clear"></div>
          <h4 class="animate-opacity"><h2 class="font-verdona" > Reassign Clients</span></h2>
        </div>
      </div>
      <div class="quarter">
        <div class="container green text-white padding-64 pointer" onclick="redirectToPage('./reports.php')">
          <div class="left"><i class="fa fa-eye xxxlarge"></i></div>
          <div class="right">
            <?php
            $query = "SELECT history.*, staff_info.name AS s_name, client_info.name AS c_name
              FROM history
              INNER JOIN `staff_info` ON history.staff_id = staff_info.staff_id
              INNER JOIN `client_info` ON history.client_id = client_info.client_id";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            echo '<h3>' . $rowCount . '</h3>';
            ?>
          </div>
          <div class="clear"></div>
          <h4 class="animate-opacity"><h2 class="font-verdona" >Reports</span></h2>
        </div>
      </div>
      <div class="quarter">
        <div class="container green padding-64 pointer" onclick="redirectToPage('./history.php')">
          <div class="left"><i class="fa fa-file user-icon xxxlarge"></i></div>
          <div class="right">
            <?php
            $query = "SELECT * FROM `history`";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            echo '<h3>' . $rowCount . '</h3>';
            ?>
          </div>
          <div class="clear"></div>
          <h4 class="animate-opacity"><h2 class="font-verdona" >Assigned Clients</span></h2>
        </div>
      </div>
      <div class="quarter">
        <div class="container green padding-64 pointer" onclick="redirectToPage('./assign_clients.php')">
          <div class="left"><i class="fa fa-user xxxlarge"></i></div>
          <div class="right">
            <?php
            $query = "SELECT client_info.client_id, client_info.name, client_info.contact, client_info.email, client_info.company_name 
              FROM `client_info`
              LEFT JOIN data_maps ON client_info.client_id = data_maps.client_id
              WHERE data_maps.client_id IS NULL";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $rowCount = $stmt->rowCount();
            echo '<h3>' . $rowCount . '</h3>';
            ?>
          </div>
          <div class="clear"></div>
          <h4 class="animate-opacity"><h2 class="font-verdona" >Assign Clients</span></h2>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Progress Bar -->

  <div class="clear padding-64"></div>
  <div class="container">
    <h2  class="font-verdona" style="font-weight: bol">New Clients</h2>
    <div class="">
      <?php
      $query = "SELECT * FROM `history` ORDER BY date DESC LIMIT 10";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $rowCount = $stmt->rowCount();
      $width = ($rowCount / 10) * 100;
      ?>
      <div class="container center padding-15 animate-opacity green" style="width: <?php echo $width; ?>%;">
        <p>
          <?php echo $rowCount; ?>
        </p>
      </div>
    </div>

    <h2 class="font-verdona" style="font-weight: bol">Declined clients</h2>
    <div class="">
      <?php
      $query = "SELECT * FROM history WHERE status_id = -1";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $rowCount = $stmt->rowCount();
      $width = ($rowCount / 10) * 100;
      ?>
      <div class="container center padding-15 animate-opacity green" style="width: <?php echo $width; ?>%;">
        <p>
          <?php echo $rowCount; ?>
        </p>
      </div>
    </div>

    <h2 class="font-verdona" style="font-weight: bol">Closed Clients</h2>
    <div class="">
      <?php
      $query = "SELECT * FROM history WHERE status_id = 2";
      $stmt = $conn->prepare($query);
      $stmt->execute();
      $rowCount = $stmt->rowCount();
      $width = ($rowCount / 10) * 100;
      ?>
      <div class="container center padding-15 animate-opacity green" style="width: <?php echo $width; ?>%;">
        <p>
          <?php echo $rowCount; ?>
        </p>
      </div>
    </div>
  </div>

  <br>
  <br>

<?php include '../components/staff_footer.php';?>

  <script>
    function redirectToPage(url) {
      window.location.href = url;
    }
  </script>
</body>
</html>