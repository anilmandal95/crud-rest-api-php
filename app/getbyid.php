<?php
include('db.php');

header('Content-Type: application/json');
//use url in this way http://localhost/rest-api-php/app/getbyid.php/?id=2
// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Get the ID from the query parameters
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
    echo $id;
    if ($id > 0) {
        // Fetch data from the database based on ID
        $sql = "SELECT * FROM user WHERE id = $id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Convert the result to an associative array
            $data = $result->fetch_assoc();

            // Output the data as JSON
            echo json_encode([
                "status" => "success", 
                "data" => $data]);
        } else {
            echo json_encode([
                "status" => "error", 
                "message" => "No data found for ID $id"]);
        }

        // Close the database connection
        $conn->close();
    } else {
        echo json_encode([
            "status" => "error", 
            "message" => "Invalid ID"]);
    }
} else {
    echo json_encode([
        "status" => "error", 
        "message" => "Invalid request method"]);
}
?>
