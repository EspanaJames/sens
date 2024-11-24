<?php
$data_file = 'sensor_data.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $distance_cm = isset($_POST['distance_cm']) ? floatval($_POST['distance_cm']) : null;
    $distance_inches = isset($_POST['distance_inches']) ? floatval($_POST['distance_inches']) : null;

    if ($distance_cm !== null && $distance_inches !== null) {
        $data = [
            'distance_cm' => $distance_cm,
            'distance_inches' => $distance_inches
        ];
        
        if (file_put_contents($data_file, json_encode($data))) {
            echo json_encode(['status' => 'success', 'message' => 'Data received and saved.']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Failed to save data.']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid or missing data.']);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');

    if (file_exists($data_file)) {
        $data = file_get_contents($data_file);
        echo $data;
    } else {
        echo json_encode(['distance_cm' => 'N/A', 'distance_inches' => 'N/A']);
    }
    exit;
}

http_response_code(405);
echo json_encode(['status' => 'error', 'message' => 'Method not allowed.']);
?>
