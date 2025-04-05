<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hanami Hospital - Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            background: #080394;
            color: white;
            text-align: center;
            padding: 10px 0;
        }
        .header a {
            color: white;
            text-decoration: none;
        }
        .header a:hover {
            text-decoration: underline;
        }
        .form-container {
            max-width: 800px;
            margin: auto;
            padding: 50px 20px;
        }
        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }
        form input, form select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .payment-options label {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .payment-options input[type="radio"] {
            margin: 0;
            width: 16px;
            height: 16px;
        }
        .btn-container {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .btn-container button {
            padding: 10px 30px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            background-color: #080394;
            color: white;
            cursor: pointer;
        }
        .btn-container button:hover {
            background-color: #030060;
        }
        .submitted-data {
            background-color: #f0f0f0;
            padding: 20px;
            margin-top: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="header">
    <h1><a href="Mainpage.php">Hanami Hospital - Information</a></h1>
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
        <input type="text" name="Contact_num" required>

        <label>Address:</label>
        <input type="text" name="Address" required>

        <label>Emergency Contact Name:</label>
        <input type="text" name="Emergency_fullname" required>

        <label>Emergency Contact Number:</label>
        <input type="text" name="Emergency_num" required>

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

<script>
function showPaymentFields() {
    const container = document.getElementById('payment-details');
    container.innerHTML = '';
    const method = document.querySelector('input[name="payment-method"]:checked').value;
    switch (method) {
        case 'credit-card':
            container.innerHTML = `
                <label>Card Number:</label>
                <input type="text" name="card_number" required>
                <label>Card Holder Name:</label>
                <input type="text" name="card_holder" required>
                <label>Expiry Date:</label>
                <input type="month" name="expiry_date" required>
                <label>CVV:</label>
                <input type="text" name="cvv" required>
            `;
            break;
        case 'paypal':
            container.innerHTML = `
                <label>PayPal Email:</label>
                <input type="email" name="paypal_email" required>
            `;
            break;
        case 'bank-transfer':
            container.innerHTML = `
                <label>Bank Name:</label>
                <input type="text" name="bank_name" required>
                <label>Account Number:</label>
                <input type="text" name="account_number" required>
                <label>Routing Number:</label>
                <input type="text" name="routing_number" required>
            `;
            break;
        case 'cash':
            container.innerHTML = `<p>Payment will be made by cash upon arrival.</p>`;
            break;
    }
}
</script>
</body>
</html>
