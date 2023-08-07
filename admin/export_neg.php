<?php

include '../components/config.php';

$select_history = $conn->prepare("
SELECT staff_info.staff_id, staff_info.name AS s_name, client_info. name AS c_name, history.description, history.date, history.status_id
FROM `staff_info`
LEFT JOIN history ON staff_info.staff_id = history.staff_id
LEFT JOIN client_info ON client_info.client_id = history.client_id
WHERE history.status_id = -1
");
$select_history->execute();

$filename = 'report_' . date('Y-m-d') . '.xlsx';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename=' . $filename);

$file = fopen('php://output', 'w');

$headers = array('Client Name', 'Staff Name', 'date', 'Report');
fputcsv($file, $headers);

while ($client_row = $select_history->fetch(PDO::FETCH_ASSOC)) {
    $row = array(
        $client_row['c_name'],
        $client_row['s_name'],
        $client_row['date'],
        $client_row['description']
    );
    fputcsv($file, $row);
}

fclose($file);

exit();
?>
