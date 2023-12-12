<?php
header('Content-Type: application/json');
include('db.php');
// Fetch data from the database
$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Convert the result to an associative array
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    // Output the data as JSON
    echo json_encode([
        "status" => "success", 
        "data" => $data]);
} else {
    echo json_encode([
        "status" => "error", 
        "message" => "No data found"]);
}

// Close the database connection
$conn->close();
?>
