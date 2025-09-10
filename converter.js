document.getElementById('currency-converter-form').addEventListener('submit', async function(event) {
    event.preventDefault();

    const amount = parseFloat(document.getElementById('amount').value);
    const fromCurrency = document.getElementById('from-currency').value;
    const toCurrency = document.getElementById('to-currency').value;

    if (isNaN(amount) || !fromCurrency || !toCurrency) {
        alert('Please fill in all fields with valid inputs.');
        return;
    }

    try {
        const apiKey = '9c4b343b8d4a71f910c2d5e1';  // Replace with your ExchangeRate-API key
        const url = `https://v6.exchangerate-api.com/v6/${apiKey}/latest/${fromCurrency}`;

        const response = await fetch(url);
        const data = await response.json();

        if (data.result === "success") {
            const rate = data.conversion_rates[toCurrency];
            const convertedAmount = (amount * rate).toFixed(2);

            document.getElementById('currency-converter-result').innerHTML = `
                <p><strong>Converted Amount:</strong> ${toCurrency} ${convertedAmount}</p>
            `;
        } else {
            throw new Error('Failed to fetch exchange rates.');
        }
    } catch (error) {
        document.getElementById('currency-converter-result').innerHTML = `
            <p>Error: ${error.message}</p>
        `;
        console.error('Error fetching exchange rates:', error);
    }
});
