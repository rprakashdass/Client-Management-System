<?php

include '../components/config.php';

$select_history = $conn->prepare("SELECT history.*, staff_info.name AS s_name , client_info.name AS c_name
                                  FROM history
                                  INNER JOIN `staff_info` ON history.staff_id = staff_info.staff_id
                                  INNER JOIN `client_info` ON history.client_id = client_info.client_id
                                ");
$select_history->execute();


$filename = 'report_' . date('Y-m-d') . '.xlsx';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename=' . $filename);

$file = fopen('php://output', 'w');

$headers = array('Client ID', 'Client Name', 'Staff ID','Staff Name', 'Date', 'Report');
fputcsv($file, $headers);

while ($client_row = $select_history->fetch(PDO::FETCH_ASSOC)) {
    $row = array(
        $client_row['client_id'],
        $client_row['c_name'],
        $client_row['staff_id'],
        $client_row['s_name'],
        $client_row['date'],
        $client_row['description']
    );
    fputcsv($file, $row);
}

fclose($file);

exit();
?>
