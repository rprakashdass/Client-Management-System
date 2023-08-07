<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./style/style.css">
<section style="overflow-x: auto;">
    <table>
      <thead>
        <tr>
          <th>Serial No</th>
          <th>Client ID</th>
          <th>Client Name</th>
          <th>Company Name</th>
          <th>Progress Date</th>
          <th>Next Contactable Date</th>
          <th>Status</th>
          <th>Description</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <?php

        $dbDateTime = '';
        $formattedDateTime = "";
        $select_clients = $conn->prepare('
        SELECT history.*, status_info.*, status_info.description AS s_description
        FROM history
        JOIN status_info ON history.status_id = status_info.status_id
        WHERE history.staff_id = ? AND status_info.status_id IN (0, 1)
    ');
    $select_clients->execute([$user_id]);

        $index = 1;

        while ($client_row = $select_clients->fetch(PDO::FETCH_ASSOC)) {
          $client_id = $client_row['client_id'];

          $collect_client = $conn->prepare('SELECT client_info.*, history.*
          FROM `client_info`
          INNER JOIN history ON client_info.client_id = history.client_id
          WHERE client_info.client_id = ?');
          $collect_client->execute([$client_id]);

          $assign_client = $collect_client->fetch(PDO::FETCH_ASSOC);

          echo "
            <tr>
            <td class='serial-number'><?= $index ?></td>
              <td>$assign_client[client_id]</td>
              <td>$assign_client[name]</td>
              <td>$assign_client[company_name]</td>
              <td><button type='date' class='-button green'>$client_row[date]</button></td>
              <td><button type='date' class='-button green'>$client_row[next_contactable]</button></td>
              <td><button class='black sticky-button'>$client_row[s_description]</button></td>
              <td>
                <a class='-button orange' href='update_status.php?client_id=$client_id'>Update Status</button>
              </td>
            </tr>
          ";
          $index++;
        }
        ?>
      </tbody>
    </table>
  </section>