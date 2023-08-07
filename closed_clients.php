<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./style/style.css">

</head>
<body>
  <table>
    <thead>
      <tr>
        <th>Serial No</th>
        <th>Client ID</th>
        <th>Client Name</th>
        <th>Email</th>
        <th>Company Name</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody id="tableBody">
      <?php

      $dbDateTime = '';
      $formattedDateTime = "";
      $select_clients = $conn->prepare('SELECT history.*, status_info.*
        FROM `history`
        INNER JOIN status_info ON history.status_id = status_info.status_id
        WHERE history.staff_id = ? AND history.status_id IN (-1, 2)');
      $select_clients->execute([$user_id]);

      $index = 1;

      while ($client_row = $select_clients->fetch(PDO::FETCH_ASSOC)) {
        $client_id = $client_row['client_id'];

        $collect_client = $conn->prepare('SELECT * FROM `client_info` where client_id = ?');
        $collect_client->execute([$client_id]);
        $assign_client = $collect_client->fetch(PDO::FETCH_ASSOC);

        $dbDateTime = $client_row['date'];
        $formattedDateTime = date('d-m-Y', strtotime($dbDateTime));

        echo "
          <tr>
            <td class='serial-number'>$index</td>
            <td>$client_row[client_id]</td>
            <td>$assign_client[name]</td>
            <td>$assign_client[email]</td>
            <td>$assign_client[company_name]</td>
            <td>
              <button type='date' class='-button w3-green'>$formattedDateTime</button>
            </td>
            <td>
              <button class='black sticky-button'>$client_row[description]</button>
            </td>
          </tr>
        ";

        $index++;
      }
      ?>
    </tbody>
  </table>

</body>
</html>