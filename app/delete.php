<?php
include('db.php');
header('Content-Type: application/json');
// Check if the request method is DELETE
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Get the ID from the query parameters
    $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

    if ($id > 0) {
        // Check if the ID exists before deleting
        $checkSql = "SELECT * FROM user WHERE id = $id";
        $checkResult = $conn->query($checkSql);

        if ($checkResult->num_rows > 0) {
            // Delete data from the database based on ID
            $deleteSql = "DELETE FROM user WHERE id = $id";
            if ($conn->query($deleteSql) === true) {
                echo json_encode([
                    "status" => "success", 
                    "message" => "Data deleted successfully"]);
            } else {
                echo json_encode([
                    "status" => "error", 
                    "message" => "Error: " . $deleteSql . "<br>" . $conn->error]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                 "message" => "Invalid ID"]);
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
