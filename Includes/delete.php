<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "reservation_sys";

$connection = mysqli_connect($servername, $username, $password, $databasename);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Prepare and execute delete statement
    $sql = "DELETE FROM apt_info WHERE id = ?";
    $stmt = mysqli_prepare($connection, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: Admin.php?message=Record deleted successfully");
        } else {
            header("Location: Admin.php?error=Error deleting record");
        }
        mysqli_stmt_close($stmt);
    } else {
        header("Location: Admin.php?error=Error preparing statement");
    }
} else {
    header("Location: Admin.php?error=No ID provided");
}

mysqli_close($connection);
?>