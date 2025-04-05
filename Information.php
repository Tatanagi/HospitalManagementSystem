<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hanami Hospital - Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./Scripts/Information.js"></script>
    <link rel="stylesheet" href="./Css/Information.css">
</head>
<body>
    <div class="background"></div>
<div class="header">
    <h1><a href="Index.php">Hanami Hospital - Information</a></h1>
</div>

<div class="form-container">
    <h2>Please fill in your details</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'config.php';
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO apt_info (Fname, Lname, Email, Contact_num, Address, Emergency_fullname, Emergency_num, Btype, Gender, Birthdate, Med_condition, Reservation, payment_method, payment_details) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }

        $payment_method = $_POST['payment-method'];
        $payment_details = match ($payment_method) {
            'credit-card' => json_encode([
                'card_number' => $_POST['card_number'],
                'card_holder' => $_POST['card_holder'],
                'expiry_date' => $_POST['expiry_date'],
                'cvv' => $_POST['cvv']
            ]),
            'paypal' => json_encode(['paypal_email' => $_POST['paypal_email']]),
            'bank-transfer' => json_encode([
                'bank_name' => $_POST['bank_name'],
                'account_number' => $_POST['account_number'],
                'routing_number' => $_POST['routing_number']
            ]),
            default => json_encode(['method' => 'cash']),
        };

        $stmt->bind_param(
            "ssssssssssssss",
            $_POST['Fname'], $_POST['Lname'], $_POST['Email'], $_POST['Contact_num'],
            $_POST['Address'], $_POST['Emergency_fullname'], $_POST['Emergency_num'],
            $_POST['Btype'], $_POST['Gender'], $_POST['Birthdate'], $_POST['Med_condition'],
            $_POST['Reservation'], $payment_method, $payment_details
        );

        if ($stmt->execute()) {
            echo "<div class='submitted-data'>
                    <h3>Form Submitted Successfully</h3>
                    <p><strong>Name:</strong> {$_POST['Fname']} {$_POST['Lname']}</p>
                    <p><strong>Email:</strong> {$_POST['Email']}</p>
                    <p><strong>Contact:</strong> {$_POST['Contact_num']}</p>
                    <p><strong>Address:</strong> {$_POST['Address']}</p>
                    <p><strong>Emergency Contact:</strong> {$_POST['Emergency_fullname']} ({$_POST['Emergency_num']})</p>
                    <p><strong>Blood Type:</strong> {$_POST['Btype']}</p>
                    <p><strong>Gender:</strong> {$_POST['Gender']}</p>
                    <p><strong>Birthdate:</strong> {$_POST['Birthdate']}</p>
                    <p><strong>Condition:</strong> {$_POST['Med_condition']}</p>
                    <p><strong>Reservation:</strong> {$_POST['Reservation']}</p>
                    <p><strong>Payment Method:</strong> $payment_method</p>
                  </div>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>

    <form method="post">
        <label>First Name:</label>
        <input type="text" name="Fname" required>

        <label>Last Name:</label>
        <input type="text" name="Lname" required>

        <label>Email:</label>
        <input type="email" name="Email" required>

        <label>Contact Number:</label>
        <input type="text" name="Contact_num" required pattern="\d{11}" maxlength="11" title="Please enter exactly 11 digits">

        <label>Address:</label>
        <input type="text" name="Address" required>

        <label>Emergency Contact Name:</label>
        <input type="text" name="Emergency_fullname" required>

        <label>Emergency Contact Number:</label>
        <input type="text" name="Emergency_num" required pattern="\d{11}" maxlength="11" title="Please enter exactly 11 digits">

        <label>Blood Type:</label>
        <select name="Btype" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
        </select>

        <label>Gender:</label>
        <select name="Gender" required>
            <option value="M">Male</option>
            <option value="F">Female</option>
            <option value="O">Other</option>
        </select>

        <label>Birthdate:</label>
        <input type="date" name="Birthdate" required>

        <label>Disease / Condition:</label>
        <input type="text" name="Med_condition" required>

        <label>Reservation Date:</label>
        <input type="datetime-local" name="Reservation" required>

        <div class="payment-options">
            <p>Please select your payment method:</p>
            <label><input type="radio" name="payment-method" value="credit-card" onclick="showPaymentFields()" required> Credit Card</label>
            <label><input type="radio" name="payment-method" value="paypal" onclick="showPaymentFields()"> PayPal</label>
            <label><input type="radio" name="payment-method" value="bank-transfer" onclick="showPaymentFields()"> Bank Transfer</label>
            <label><input type="radio" name="payment-method" value="cash" onclick="showPaymentFields()"> Cash</label>
        </div>

        <div id="payment-details" class="payment-details"></div>

        <div class="btn-container">
            <button type="button" onclick="window.history.back()">Back</button>
            <button type="submit">Submit</button>
        </div>
    </form>
</div>
</body>
</html>
