function showPaymentFields() {
    const container = document.getElementById('payment-details');
    container.innerHTML = '';
    const method = document.querySelector('input[name="payment-method"]:checked').value;

    switch (method) {
        case 'credit-card':
            container.innerHTML = `
                <label>Card Number:</label>
                <input type="text" name="card_number" required pattern="\\d{13,19}" title="Enter a valid credit card number (13 to 19 digits)" maxlength="19">
                
                <label>Card Holder Name:</label>
                <input type="text" name="card_holder" required pattern="[A-Za-z ]{2,50}" title="Enter a valid name using only letters and spaces">
                
                <label>Expiry Date:</label>
                <input type="date" name="expiry_date" required> <!-- Changed to date input -->
                
                <label>CVV:</label>
                <input type="text" name="cvv" required pattern="\\d{3,4}" maxlength="4" title="Enter 3 or 4 digit CVV code">
            `;
            break;

        case 'paypal':
            container.innerHTML = `
                <label>PayPal Email:</label>
                <input type="email" name="paypal_email" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$" title="Please enter a valid PayPal email address">
            `;
            break;

        case 'bank-transfer':
            container.innerHTML = `
                <label>Bank Name:</label>
                <input type="text" name="bank_name" required pattern="[A-Za-z ]{2,100}" title="Enter a valid bank name">
                
                <label>Account Number:</label>
                <input type="text" name="account_number" required pattern="\\d{8,20}" title="Enter a valid account number (8 to 20 digits)">
                
                <label>Routing Number:</label>
                <input type="text" name="routing_number" required pattern="\\d{9}" title="Enter a 9-digit routing number">
            `;
            break;

        case 'cash':
            container.innerHTML = `<p>Payment will be made by cash upon arrival.</p>`;
            break;
    }
}
