<?php 
include '../components/config.php';

$select_clients = $conn->prepare("SELECT client_info.client_id, client_info.name, client_info.contact, client_info.email, client_info.company_name 
                                  FROM `client_info`
                                  LEFT JOIN data_maps ON client_info.client_id = data_maps.client_id
                                  WHERE data_maps.client_id IS NOT NULL
                                  ");

$select_clients->execute();
$client_rows = $select_clients->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_id = $_POST['client_id'];
    $staff_id = $_POST['staff_id'];
    $status_id = '1'; // 0 is for assigned
    $desc = 'Client Assigned'; //default
    $date_of_prog = date('Y-m-d');

    if (empty($_POST['staff_id'])) {
        echo 'Please enter the staff id to update!';
    } else {

        $delete_clients = $conn->prepare("DELETE FROM `data_maps` WHERE client_id = ?");
        $delete_clients->execute([$client_id]);        

        $assign_clients = $conn->prepare("INSERT INTO `data_maps` (client_id, staff_id, status_id, date_of_progress) VALUES (?, ?, ?, ?)");
        $assign_clients->execute([$client_id, $staff_id, $status_id, $date_of_prog]);

        $update_history = $conn->prepare("INSERT INTO `history` (client_id, staff_id, status_id, date, description) VALUES (?, ?, ?, ?, ?)");
        $update_history->execute([$client_id, $staff_id, $status_id, $date_of_prog, $desc]);

        echo 'Client allocated successfully';
    }
    header('Location: ../admin/admin_dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../style/style.css">
</head>
<body style="margin:23px;">
<table>
  <thead>
  <tr>
    <th>Serial Number</th>
    <th>Client ID</th>
    <th>Client Name</th>
    <th>Contact</th>
    <th>Email</th>
    <th>Company Name</th>
    <th>Enter staff id to assign clients:</th>
    <th> </th>
  </tr>
  </thead>
  <tbody>
    <?php
    $select_clients->execute();
    $serialNumber = 1;
    while ($client_row = $select_clients->fetch(PDO::FETCH_ASSOC)) {
        ?> 
        <tr>
          <form method="post">
          <td class="serial-number"><?= $serialNumber ?></td>
            <td><input type="hidden" name="client_id" value="<?php echo $client_row['client_id']; ?>"><?= $client_row['client_id'] ?></td>
            <td><?= $client_row['name'] ?></td>
            <td><?= $client_row['contact'] ?></td>
            <td><?= $client_row['email'] ?></td>
            <td><?= $client_row['company_name'] ?></td>
            <td>
              <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
              <input class='blue' type='text' name="staff_id">
            </td>
            <td><button type="submit" class='-button green'>Update</button></td>
          </form>
        </tr> 
        <?php
                  $serialNumber++;
    }
    ?>
  </tbody>
</table>

</body>
</html>