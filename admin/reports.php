<?php 
include('../components/config.php');

$select_history = $conn->prepare("SELECT history.*, staff_info.name AS s_name, client_info.name AS c_name
                                  FROM history
                                  INNER JOIN `staff_info` ON history.staff_id = staff_info.staff_id
                                  INNER JOIN `client_info` ON history.client_id = client_info.client_id
                                ");
$select_history->execute();
?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../style/style.css">
</head>

<body style="margin: 23px;">


<br>

<a href="./export_pos.php"><button type="button" class="-button green" style="margin-left: 60px;" name="button">Export Positive Reports</button></a>   
<a href="./export_neg.php"><button type="button" class="-button green" style="margin-left: 60px;" name="button">Export Negative Reports</button></a>  
<a href="./export_staff.php"><button type="button" class="-button green" style="margin-left: 60px;" name="button">Export Staff Report</button></a>             
<a href="./export_history.php"><button type="button" class="-button green" style="margin-left: 60px;" name="button">Export Overall Report</button></a>             
<a href="./export_history.php"><button type="button" class="-button green" style="margin-left: 50px;" name="button">Recently Added Report</button></a>             

<br><br>

<section>
  <table>
    <thead>
      <tr>
        <th>Serial No</th>
        <th>Client ID</th>
        <th>Client Name</th>
        <th>Staff ID</th>
        <th>Staff Name</th>
        <th>Report</th>
      </tr>
    </thead>
    <tbody id="tableBody">
      <?php
      $serialNumber = 1;
      while ($client_row = $select_history->fetch(PDO::FETCH_ASSOC)) {
          ?> 
          <tr>
              <td class="serial-number"><?= $serialNumber ?></td>
              <td><?= $client_row['client_id'] ?></td>
              <td><?= $client_row['c_name'] ?></td>
              <td><?= $client_row['staff_id'] ?></td>
              <td><?= $client_row['s_name'] ?></td>
              <td><?= $client_row['description'] ?></td>
          </tr> 
          <?php
          $serialNumber++;
      }
      ?>
    </tbody>
  </table>
</section>

</body>
</html>