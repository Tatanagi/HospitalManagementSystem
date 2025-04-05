<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        } 
        .header {
            background: #080394;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 10px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 2;
        }
        .header h1 {
            color: white;
            font-size: 35px;
            margin-left: 20px;
        }
        .admin-button {
            background-color: #f39c12;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-right: 20px;
        }
        .admin-button:hover {
            background-color: #e67e22;
        }
        .footer {
            background: #080394;
            width: 100%;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            padding: 50px 0;
            z-index: 2;
        }
        .my-button {
            background-color: #0b03d0;
            color: white;
            padding: 20px 250px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .my-button:hover {
            background-color: #030060;
        }  
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://st3.depositphotos.com/2712843/14504/i/450/depositphotos_145046321-stock-photo-blurred-hospital-background.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            z-index: -1;
        } 
        .background::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.5);
        }
        .content {
            flex: 1;
            padding: 150px 20px 100px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="background"></div>

    <header class="header">
        <h1>Hanami Hospital</h1>
    </header>

    <div class="content">
        <h2 class="text-center mb-4">List of All Hospitals</h2>
        
        <?php
        // Display success or error messages if present
        if (isset($_GET['message'])) {
            echo "<div class='alert alert-success'>" . htmlspecialchars($_GET['message']) . "</div>";
        }
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-danger'>" . htmlspecialchars($_GET['error']) . "</div>";
        }
        ?>

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
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
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $databasename = "reservation_sys";
                    
                    $connection = mysqli_connect($servername, $username, $password, $databasename);

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
        <a href="MainPage.php">
            <button class="my-button">Back</button>
        </a>
    </footer>
</body>
</html>