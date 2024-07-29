<?php
include 'config.php';

header('Content-Type: application/json');

$charts = [];

$query = "SELECT mood, DATE(date) as date FROM moods ORDER BY date";
$result = $conn->query($query);
$charts['moods'] = [];
while ($row = $result->fetch_assoc()) {
    $charts['moods'][] = $row;
}

$query = "SELECT medication_name, dosage, DATE(date) as date FROM medications ORDER BY date";
$result = $conn->query($query);
$charts['medications'] = [];
while ($row = $result->fetch_assoc()) {
    $charts['medications'][] = $row;
}

$query = "SELECT hours_slept, DATE(date) as date FROM sleep ORDER BY date";
$result = $conn->query($query);
$charts['sleep'] = [];
while ($row = $result->fetch_assoc()) {
    $charts['sleep'][] = $row;
}

$query = "SELECT entry, DATE(date) as date FROM journals ORDER BY date";
$result = $conn->query($query);
$charts['journals'] = [];
while ($row = $result->fetch_assoc()) {
    $charts['journals'][] = $row;
}

$conn->close();
echo json_encode($charts);
?>
