<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $date = $_POST['date'];

    if ($type == 'mood') {
        $mood = $_POST['mood'];
        $sql = "INSERT INTO moods (mood, date) VALUES ('$mood', '$date')";
    } elseif ($type == 'medication') {
        $medication_name = $_POST['medication_name'];
        $dosage = $_POST['dosage'];
        $sql = "INSERT INTO medications (medication_name, dosage, date) VALUES ('$medication_name', '$dosage', '$date')";
    } elseif ($type == 'sleep') {
        $hours_slept = $_POST['hours_slept'];
        $sql = "INSERT INTO sleep (hours_slept, date) VALUES ('$hours_slept', '$date')";
    } elseif ($type == 'journal') {
        $entry = $_POST['entry'];
        $sql = "INSERT INTO journals (entry, date) VALUES ('$entry', '$date')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

?>

<html> <head><meta http-equiv="refresh" content="2;url=index.php"></head></html>