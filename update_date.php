<?php
$data_file = 'sensor_data.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $distance_cm = $_POST['distance_cm'];
  $distance_inches = $_POST['distance_inches'];

  $data = [
    'distance_cm' => $distance_cm,
    'distance_inches' => $distance_inches
  ];
  file_put_contents($data_file, json_encode($data));

  echo "Data received and saved.";
  exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  if (file_exists($data_file)) {
    $data = file_get_contents($data_file);
    header('Content-Type: application/json');
    echo $data;
  } else {
    echo json_encode(['distance_cm' => 'N/A', 'distance_inches' => 'N/A']);
  }
}
?>
