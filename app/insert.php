<?php
include('db.php');
header('Content-Type: application/json');
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Validate data
    if (isset($data['name']) && isset($data['email']) && isset($data['password'])) {
        // Sanitize input data
        $name = $conn->real_escape_string($data['name']);
        $email = $conn->real_escape_string($data['email']);
        $password = $conn->real_escape_string($data['password']);

        // Insert data into the database
        $sql = "INSERT INTO user (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($sql) === true) {
            echo json_encode([
                "status" => "success", 
                "message" => "Data inserted successfully"]);
        } else {
            echo json_encode([
                "status" => "error", 
                "message" => "Error: " . $sql . "<br>" . $conn->error]);
        }

        // Close the database connection
        $conn->close();
    } else {
        echo json_encode(["status" => "error", 
        "message" => "Invalid data"]);
    }
} else {
    echo json_encode(["status" => "error", 
    "message" => "Invalid request method"]);
}
?>
