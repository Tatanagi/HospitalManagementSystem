<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page - Hanami Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./Css/Admin.css">
</head>
<body>
    <div class="background"></div>

    <header class="header">
        <h1>Hanami Hospital</h1>
    </header>

    <div class="content">
        <h2 class="text-center mb-4">Admin Page</h2>

        <?php
        if (isset($_GET['message'])) {
            echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message']) . "</div>";
        }
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error']) . "</div>";
        }
        ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-primary">
                    <tr>
                        <th>Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Emergency Contact Name</th>
                        <th>Emergency Contact Number</th>
                        <th>Blood Type</th>
                        <th>Gender</th>
                        <th>Birth Date</th>
                        <th>Medical Condition</th>
                        <th>Reservation Date and Time</th>
                        <th>Payment Method</th>
                        <th>Payment Details</th>
                        <th>Date Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    include 'config.php';
                    $connection = mysqli_connect($servername, $username, $password, $dbname);

                    if (!$connection) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    $sql = "SELECT * FROM apt_info";
                    $result = mysqli_query($connection, $sql);

                    if (!$result) {
                        die("Query failed: " . mysqli_error($connection));
                    }

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['id']) . "</td>
                            <td>" . htmlspecialchars($row['Fname']) . "</td>
                            <td>" . htmlspecialchars($row['Lname']) . "</td>
                            <td>" . htmlspecialchars($row['Email']) . "</td>
                            <td>" . htmlspecialchars($row['Contact_num']) . "</td>
                            <td>" . htmlspecialchars($row['Address']) . "</td>
                            <td>" . htmlspecialchars($row['Emergency_fullname']) . "</td>
                            <td>" . htmlspecialchars($row['Emergency_num']) . "</td>
                            <td>" . htmlspecialchars($row['Btype']) . "</td>
                            <td>" . htmlspecialchars($row['Gender']) . "</td>
                            <td>" . htmlspecialchars($row['Birthdate']) . "</td>
                            <td>" . htmlspecialchars($row['Med_condition']) . "</td>
                            <td>" . htmlspecialchars($row['Reservation']) . "</td>
                            <td>" . htmlspecialchars($row['payment_method']) . "</td>
                            <td>" . htmlspecialchars($row['payment_details']) . "</td>
                            <td>" . htmlspecialchars($row['created_at']) . "</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='update.php?id=" . $row['id'] . "'>Update</a>
                                <a class='btn btn-danger btn-sm' href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\");'>Delete</a>
                            </td>
                        </tr>";
                    }

                    mysqli_close($connection);
                ?>
                </tbody>
            </table>
        </div>
    </div>

    <footer class="footer">
        <a href="Index.php">
            <button class="my-button">Back</button>
        </a>
    </footer>
</body>
</html>
