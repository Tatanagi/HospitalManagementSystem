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