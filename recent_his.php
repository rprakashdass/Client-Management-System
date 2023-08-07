<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./style/style.css">
</head>
<body>
  <main>
    <section>
      <table>
        <thead>
          <tr style="font-size: large">
            <th>Serial No</th>
            <th>Client ID</th>
            <th>Client Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Company Name</th>
            <th>Deadline</th>
            <th>Current Status</th>
          </tr>
        </thead>
        <tbody id="tableBody">

          <?php

          $dbDateTime = '';
          $formattedDateTime = "";
          $select_clients = $conn->prepare('SELECT data_maps.*, status_info.* ,status_info.description AS s_desc
            FROM `data_maps`
            INNER JOIN status_info ON data_maps.status_id = status_info.status_id
            WHERE data_maps.staff_id = ?'
          );
          $select_clients->execute([$user_id]);

          $index = 1;

          while ($client_row = $select_clients->fetch(PDO::FETCH_ASSOC)) {

            $client_id = $client_row['client_id'];

            $collect_client = $conn->prepare('SELECT * FROM `client_info` where client_id = ?');
            $collect_client->execute([$client_id]);
            $assign_client = $collect_client->fetch(PDO::FETCH_ASSOC);

            $dbDateTime = $client_row['date_of_progress'];
            $formattedDateTime = date('d-m-Y', strtotime($dbDateTime));

            echo "
              <tr>
                <td class='serial-number'>$index</td>
                <td>$client_row[client_id]</td>
                <td>$assign_client[name]</td>
                <td>$assign_client[contact]</td>
                <td>$assign_client[email]</td>
                <td>$assign_client[company_name]</td>
                <td>
                  <button type='date' class='-button green'>$formattedDateTime</button>
                </td>
                <td>
                  <button class='black sticky-button'>$client_row[s_desc]</button>
                </td>
              </tr>
            ";
            $index++;
          }
          ?>

        </tbody>
      </table>
    </section>
  </main>

</body>
</html>
