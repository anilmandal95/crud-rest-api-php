<?php
include('db.php');
header('Content-Type: application/json');
// Check if the request method is PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Get the ID from the query parameters
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id > 0) {
        // Get data from the request body
        $data = json_decode(file_get_contents("php://input"), true);

        // Validate data
        if (isset($data['name']) || isset($data['email']) || isset($data['password'])) {
            // Prepare the update query
            $updateFields = [];
            if (isset($data['name'])) {
                $updateFields[] = "name = '" . $conn->real_escape_string($data['name']) . "'";
            }
            if (isset($data['email'])) {
                $updateFields[] = "email = '" . $conn->real_escape_string($data['email']) . "'";
            }
            if (isset($data['password'])) {
                $updateFields[] = "password = '" . $conn->real_escape_string($data['password']) . "'";
            }

            // Update data in the database based on ID
            $sql = "UPDATE user SET " . implode(', ', $updateFields) . " WHERE id = $id";
            if ($conn->query($sql) === true) {
                echo json_encode([
                    "status" => "success", 
                    "message" => "Data updated successfully"]);
            } else {
                echo json_encode([
                    "status" => "error",
                     "message" => "Error: " . $sql . "<br>" . $conn->error]);
            }

            // Close the database connection
            $conn->close();
        } else {
            echo json_encode([
                "status" => "error", 
                "message" => "Invalid data"]);
        }
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
