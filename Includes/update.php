<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Hospital Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
        }
    </style>
</head>
<body>
    <?php
    include 'config.php';
    $connection = mysqli_connect($servername, $username, $password, $dbname);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get record to update
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM apt_info WHERE id = ?";
        $stmt = mysqli_prepare($connection, $sql);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
    } else {
        header("Location: Admin.php?error=No ID provided");
        exit;
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $fname = $_POST['Fname'];
        $lname = $_POST['Lname'];
        $email = $_POST['Email'];
        $contact = $_POST['Contact_num'];
        $address = $_POST['Address'];
        $emergency_name = $_POST['Emergency_fullname'];
        $emergency_num = $_POST['Emergency_num'];
        $blood_type = $_POST['Btype'];
        $gender = $_POST['Gender'];
        $birthdate = $_POST['Birthdate'];
        $med_condition = $_POST['Med_condition'];
        $reservation = $_POST['Reservation'];
        $payment_method = $_POST['payment_method'];

        $sql = "UPDATE apt_info SET Fname=?, Lname=?, Email=?, Contact_num=?, Address=?, 
                Emergency_fullname=?, Emergency_num=?, Btype=?, Gender=?, Birthdate=?, 
                Med_condition=?, Reservation=?, payment_method=? WHERE id=?";
        
        $stmt = mysqli_prepare($connection, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssssssssssssi", 
                $fname, $lname, $email, $contact, $address, $emergency_name,
                $emergency_num, $blood_type, $gender, $birthdate, $med_condition,
                $reservation, $payment_method, $id
            );
            
            if (mysqli_stmt_execute($stmt)) {
                header("Location: Admin.php?message=Record updated successfully");
            } else {
                echo "Error updating record: " . mysqli_error($connection);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($connection);
        }
    }
    ?>

    <div class="form-container">
        <h2>Update Record</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
            
            <div class="mb-3">
                <label class="form-label">First Name:</label>
                <input type="text" class="form-control" name="Fname" value="<?php echo htmlspecialchars($row['Fname']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Last Name:</label>
                <input type="text" class="form-control" name="Lname" value="<?php echo htmlspecialchars($row['Lname']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" name="Email" value="<?php echo htmlspecialchars($row['Email']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contact Number:</label>
                <input type="text" class="form-control" name="Contact_num" value="<?php echo htmlspecialchars($row['Contact_num']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Address:</label>
                <input type="text" class="form-control" name="Address" value="<?php echo htmlspecialchars($row['Address']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Emergency Contact Name:</label>
                <input type="text" class="form-control" name="Emergency_fullname" value="<?php echo htmlspecialchars($row['Emergency_fullname']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Emergency Contact Number:</label>
                <input type="text" class="form-control" name="Emergency_num" value="<?php echo htmlspecialchars($row['Emergency_num']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Blood Type:</label>
                <select class="form-select" name="Btype" required>
                    <?php
                    $blood_types = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
                    foreach ($blood_types as $type) {
                        $selected = $row['Btype'] == $type ? 'selected' : '';
                        echo "<option value='$type' $selected>$type</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gender:</label>
                <select class="form-select" name="Gender" required>
                    <?php
                    $genders = ['M' => 'Male', 'F' => 'Female', 'O' => 'Other'];
                    foreach ($genders as $key => $value) {
                        $selected = $row['Gender'] == $key ? 'selected' : '';
                        echo "<option value='$key' $selected>$value</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Birthdate:</label>
                <input type="date" class="form-control" name="Birthdate" value="<?php echo htmlspecialchars($row['Birthdate']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Medical Condition:</label>
                <input type="text" class="form-control" name="Med_condition" value="<?php echo htmlspecialchars($row['Med_condition']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Reservation Date:</label>
                <input type="datetime-local" class="form-control" name="Reservation" value="<?php echo htmlspecialchars($row['Reservation']); ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Payment Method:</label>
                <select class="form-select" name="payment_method" required>
                    <?php
                    $payment_methods = ['credit-card' => 'Credit Card', 'paypal' => 'PayPal', 'bank-transfer' => 'Bank Transfer', 'cash' => 'Cash'];
                    foreach ($payment_methods as $key => $value) {
                        $selected = $row['payment_method'] == $key ? 'selected' : '';
                        echo "<option value='$key' $selected>$value</option>";
                    }
                    ?>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="Admin.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <?php
    mysqli_close($connection);
    ?>
</body>
</html>